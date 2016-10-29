<?php

use PetShop\DataBase\Factory;
/**
 * Class EntidadeDao
 * TODO implementar escape de string
 * TODO implementar validação de obrigatoriedade (not null) nas configurações
 * TODO implementar Validator nas configurações e aplicação.
 * TODO implementar valores máximos e mínimos
 * TODO implementar tamanho máximo do campo
 */
abstract class EntidadeDao {

  private $oBanco;

  /**
   * @var string Nome da Classe para manipulação da entidade.
   */
  protected $sClasse;

  /**
   * @var string Nome da Tabela para persistência da entidade.
   */
  protected $sTabela;

  /**
   * @var array Configurações para mapeamento de colunas, atributos e chaves entre classe e tabela da entidade.
   */
  protected $aConfiguracoes;

  public function __construct() {
    $this->oBanco = Factory::getBanco();
  }

  public function iniciaTransacao() {
    return $this->oBanco->iniciaTransacao();
  }

  public function encerraTransacao($lErro) {
    return $this->oBanco->encerraTransacao($lErro);
  }

  public function isTrasacao() {
    return $this->isTrasacao();
  }

  /**
   * De acordo com o tipo do dado configurado, retorna o valor da entidade já formatado para utilização em querys SQL.
   * @param $oEntidade
   * @param $aConfiguracao
   * @return string
   */
  protected function getValorTipo($oEntidade, $aConfiguracao) {

    switch ($aConfiguracao['tipo']) {

      case TipoDado::STRING:

        $sValor = "'" . $oEntidade->{"get" . $aConfiguracao['atributo']}() . "'";
        break;

      case TipoDado::DATA:

        $sValor = "'" . $oEntidade->{"get" . $aConfiguracao['atributo']}()->format("Y-m-d") . "'";
        break;

      case TipoDado::BOOLEAN:

        $sValor = $oEntidade->{"is" . $aConfiguracao['atributo']}() ? 'true' : 'false';
        break;

      default:

        $sValor = $oEntidade->{"get" . $aConfiguracao['atributo']}();
        break;
    }

    if (empty($sValor) && $aConfiguracao['nulo']) {
      $sValor = "null";
    }

    return $sValor;
  }

  /**
   * Busca um registro de uma entidade com base no código e na clásula.
   * @param int $iChave Código identificador do registro da entidade.
   * @param string $sWhere Cláusula para filtragem.
   * @param object $oObject Objeto para ser preenchido no lugar de instanciar um novo.
   * @return bool|Object
   */
  public function buscarPorCodigo($iChave = null, $sWhere = "", $oObject = null) {

    $aWhere = array();
    if (!is_null($iChave)) {

      $sWhereChave = "";
      foreach ($this->aConfiguracoes as $aConfiguracao) {

        if ($aConfiguracao['chave_primaria']) {

          $sWhereChave = $aConfiguracao['coluna'] . " = {$iChave}";
          break;
        }
      }

      if (!empty($sWhereChave)) {
        $aWhere[] = $sWhereChave;
      }
    }

    if (!empty($sWhere)) {
      $aWhere[] = $sWhere;
    }

    $sWhere = implode(" and ", $aWhere);

    if (!empty($sWhere)) {
      $sWhere = " where {$sWhere} ";
    }

    $sSql = "select * from {$this->sTabela} $sWhere";

    $this->oBanco->conectar();
    $rsResultado   = $this->oBanco->query($sSql);
    $iNumeroLinhas = $this->oBanco->numeroLinhas($rsResultado);

    if ($iNumeroLinhas == 0) {
      return false;
    }

    $oRegistro = $this->oBanco->getResgitro($rsResultado, 0);

    $oEntidade = $oObject;
    if (is_null($oEntidade)) {
      $oEntidade = new $this->sClasse();
    }

    foreach ($this->aConfiguracoes as $aConfiguracao) {

      $sValor = $oRegistro->{$aConfiguracao['coluna']};
      if ($aConfiguracao['chave_estrangeira'] && !empty($sValor)) {
        $sValor = new $aConfiguracao['chave_estrangeira']($sValor);
      }

      if ($aConfiguracao['tipo'] == TipoDado::DATA) {
        $sValor = new DateTime($sValor);
      }
      $oEntidade->{"set{$aConfiguracao['atributo']}"}($sValor);
    }

    $this->oBanco->fecharConexao();

    return $oEntidade;
  }

  /**
   * Contabiliza e retorna a quantidade de registros de um entidade com base na clausula passada por parâmetro.
   * @param string $sWhere Clausúla para realização da contabilização de registros da busca.
   * @return int
   * @throws Exception
   */
  public function contar($sWhere = "") {

    if (!empty($sWhere)) {
      $sWhere = " where {$sWhere} ";
    }

    $sChave = "*";
    foreach ($this->aConfiguracoes as $aConfiguracao) {

      if ($aConfiguracao['chave_primaria']) {
        $sChave = $aConfiguracao['coluna'];
      }
    }

    $sSql = "select count({$sChave}) as total from {$this->sTabela} {$sWhere} ";

    $this->oBanco->conectar();

    $rsResultado = $this->oBanco->query($sSql);
    $iNumeroLinhas = $this->oBanco->numeroLinhas($rsResultado);

    if ($iNumeroLinhas !== 1) {
      throw new Exception("Houve um erro ao buscar os registros. Avise o suporte.");
    }

    $oRegistros = $this->oBanco->getResgitro($rsResultado, 0);

    $this->oBanco->fecharConexao();

    return $oRegistros->total;
  }

  /**
   * Realiza uma busca pelos registros da entidade, retornando uma coleção de objetos da entidade.
   * @param string $sCampos Campos a serem retornados na busca.
   * @param string $sWhere Clausula para busca.
   * @param Paginacao|null $oPaginacao Objeto para controle de paginação dos resultados.
   * @return array|bool
   */
  public function buscar($sCampos = "*", $sWhere = "", $sOrder = "", Paginacao $oPaginacao = null) {

    if (!empty($sWhere)) {
      $sWhere = " where $sWhere ";
    }

    if (!empty($sOrder)) {
      $sOrder = " order by {$sOrder} ";
    }

    $sSql = "select {$sCampos} from {$this->sTabela} $sWhere {$sOrder} ";
    if (!is_null($oPaginacao)) {
      $sSql .= $oPaginacao->getSql();
    }

    $this->oBanco->conectar();

    $rsResultado = $this->oBanco->query($sSql);

    $iNumeroLinhas = $this->oBanco->numeroLinhas($rsResultado);

    if ($iNumeroLinhas == 0) {
      return array();
    }

    $aEntidades = array();
    for ($i = 0; $i < $iNumeroLinhas; $i++) {

      $oRegistro = $this->oBanco->getResgitro($rsResultado, $i);
      $oEntidade = new $this->sClasse();
      foreach ($this->aConfiguracoes as $aConfiguracao) {

        if (!isset($oRegistro->{$aConfiguracao['coluna']})) {
          continue;
        }

        $sValor = $oRegistro->{$aConfiguracao['coluna']};
        if ($aConfiguracao['tipo'] == TipoDado::DATA) {
          $sValor = new DateTime($sValor);
        }
        $oEntidade->{"set{$aConfiguracao['atributo']}"}($sValor);
      }
      $aEntidades[] = $oEntidade;
    }

    $this->oBanco->fecharConexao();

    return $aEntidades;
  }

  /**
   * Verifica se deve atualizar ou inserir um registro de acordo as informações de chave primária.
   * @param $oEntidade
   * @return bool
   */
  public function salvar($oEntidade) {

    foreach ($this->aConfiguracoes as $aConfiguracao) {

      if (!$aConfiguracao['chave_primaria']) {
        continue;
      }

      if (empty($oEntidade->{"get" . $aConfiguracao['atributo']}())) {
        return $this->inserir($oEntidade);
      }
    }
    return $this->atualizar($oEntidade);
  }

  /**
   * Insere um novo registro de acordo com a entidade informada.
   * @param $oEntidade
   * @return bool|mysqli_result
   * TODO tratar e validar retorno do insert
   */
  public function inserir($oEntidade) {

    $this->oBanco->conectar();

    $aColunas = array();
    $aValores = array();

    foreach ($this->aConfiguracoes as $aConfiguracao) {

      $sValor = $this->getValorTipo($oEntidade, $aConfiguracao);

      if ($aConfiguracao['chave_estrangeira'] && is_object($sValor)) {
        $sValor = $sValor->getCodigo();
      }

      if (!$aConfiguracao['chave_primaria']) {

        $aColunas[] = $aConfiguracao['coluna'];
        $aValores[] = $sValor;
        continue;
      }
    }

    $sColunas = implode(",", $aColunas);
    $sValores = implode(",", $aValores);

    $sSql = "insert into {$this->sTabela} ({$sColunas}) values ({$sValores}) ";

    $lRetorno = $this->oBanco->query($sSql);

    if ($lRetorno) {

      $id = $this->oBanco->ultimoId();
      foreach ($this->aConfiguracoes as $aConfiguracao) {

        if ($aConfiguracao['chave_primaria']) {
          $oEntidade->{"set" . $aConfiguracao['atributo']}($id);
        }
      }
    }

    $this->oBanco->fecharConexao();

    return $lRetorno;
  }

  /**
   * Atualiza um registro bom base na entidade informada e nas configurações de chave primária.
   * @param $oEntidade
   * @return bool|mysqli_result
   * TODO tratar e validar retorno da atualização
   */
  protected function atualizar($oEntidade) {

    $this->oBanco->conectar();

    $aColunas = array();
    $aValores = array();
    $aWhere = array();

    foreach ($this->aConfiguracoes as $aConfiguracao) {

      $sValor = $this->getValorTipo($oEntidade, $aConfiguracao);
      if (!$aConfiguracao['chave_primaria']) {

        $aColunas[] = $aConfiguracao['coluna'];

        if ($aConfiguracao['chave_estrangeira'] && is_object($sValor)) {
          $sValor = $sValor->getCodigo();
        }
        $aValores[] = $sValor;
        continue;
      }
      $aWhere[] = $aConfiguracao['coluna'] . " = " . $sValor;
    }

    $aSet = array();
    for ($i = 0; $i < count($aColunas); $i++) {
      $aSet[] = $aColunas[$i] . " = " . $aValores[$i];
    }

    $sSet = implode(", ", $aSet);
    $sWhere = implode(" and ", $aWhere);

    $sSql = "update {$this->sTabela} set {$sSet} where {$sWhere} ";

    $lRetorno = $this->oBanco->query($sSql);

    $this->oBanco->fecharConexao();

    return $lRetorno;
  }

  /**
   * Exclui um registro com base nas chaves primárias encontradas.
   * @param $oEntidade
   * @return bool|mysqli_result
   * @throws Exception
   * TODO Verificar e validar retorno do delete.
   */
  public function excluir($oEntidade) {

    $aWhere = "";
    foreach ($this->aConfiguracoes as $aConfiguracao) {

      if ($aConfiguracao['chave_primaria']) {
        $aWhere[] = $aConfiguracao['coluna'] . " = " . $this->getValorTipo($oEntidade, $aConfiguracao);
      }
    }

    $sWhere = implode(" and ", $aWhere);
    if (empty($sWhere)) {
      throw new Exception("Código identificador do registro não informado.");
    }

    $this->oBanco->conectar();
    $sSql = " delete from {$this->sTabela} where {$sWhere} ";

    $lRetorno = $this->oBanco->query($sSql);

    $this->oBanco->fecharConexao();

    return $lRetorno;
  }
}