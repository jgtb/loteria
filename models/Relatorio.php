<?php

namespace app\models;

use Yii;

class Relatorio extends \yii\db\ActiveRecord {

    public $id_mensal, $data_mensal, $periodo;

    public static function tableName() {
        return 'relatorio';
    }

    public function rules() {
        return [
            [['id'], 'required', 'message' => 'Campo obrigatório'],
            [['periodo_inicial', 'periodo_final'], 'safe'],
            [['ano'], 'required', 'when' => function ($model) {
                    return $model->mes_ano == NULL && $model->periodo == NULL;
                }, 'message' => 'Campo obrigatório'],
            [['mes_ano'], 'required', 'when' => function ($model) {
                    return $model->ano == NULL && $model->periodo == NULL;
                }, 'message' => 'Campo obrigatório'],
            [['periodo'], 'required', 'when' => function ($model) {
                    return $model->mes_ano == NULL && $model->ano == NULL;
                }, 'message' => 'Campo obrigatório'],
        ];
    }

    public function attributeLabels() {
        return [
            'relatorio_id' => 'Relatorio ID',
            'id' => 'Relatório',
            'ano' => 'Ano',
            'mes_ano' => 'Mês',
        ];
    }

    public function getRelatorio() {
        $relatorios = ['Jogos', 'Serviços', 'Despesas', 'Resumo', 'Retiradas', 'Despesas', 'Despesas'];

        return $relatorios[$this->id - 1];
    }

    public function getValor($dia, $mes) {
        switch ($this->id) {
            case 1:
                return (double) Jogo::find()->where(['YEAR(data)' => $this->ano, 'MONTH(data)' => $mes, 'DAY(data)' => $dia])->sum('valor');
                break;
            case 2:
                return (double) Servico::find()->where(['YEAR(data)' => $this->ano, 'MONTH(data)' => $mes, 'DAY(data)' => $dia])->sum('valor');
                break;
            case 3:
                return (double) Despesa::find()->where(['YEAR(data)' => $this->ano, 'MONTH(data)' => $mes, 'DAY(data)' => $dia])->sum('valor');
                break;
        }
    }

    public function getValorTotal($mes) {
        switch ($this->id) {
            case 1:
                return (double) Jogo::find()->where(['YEAR(data)' => $this->ano, 'MONTH(data)' => $mes])->sum('valor');
                break;
            case 2:
                return (double) Servico::find()->where(['YEAR(data)' => $this->ano, 'MONTH(data)' => $mes])->andWhere(['DAY(data)' => [2, 12, 22]])->sum('valor');
                break;
            case 3:
                return (double) Despesa::find()->where(['YEAR(data)' => $this->ano, 'MONTH(data)' => $mes])->sum('valor');
                break;
        }
    }

    public function getComissaoJogos($mes, $ano) {
        return (double) Jogo::find()->where(['YEAR(data)' => $ano, 'MONTH(data)' => $mes])->sum('valor');
    }

    public function getComissaoServicos($mes, $ano) {
        return (double) Servico::find()->where(['YEAR(data)' => $ano, 'MONTH(data)' => $mes])->sum('valor');
    }

    public function getTotalReceitas($mes, $ano) {
        return $this->getComissaoJogos($mes, $ano) + $this->getComissaoServicos($mes, $ano);
    }

    public function getTotalDespesas($mes, $ano) {
        return (double) Despesa::find()->where(['YEAR(data)' => $ano, 'MONTH(data)' => $mes])->sum('valor');
    }

    public function getValorDespesaDia($dia, $categoriaID) {
        return (double) Despesa::find()->where(['YEAR(data)' => date('Y', strtotime($this->mes_ano)), 'MONTH(data)' => date('m', strtotime($this->mes_ano)), 'DAY(data)' => $dia, 'categoria_id' => $categoriaID])->sum('valor');
    }

    public function getValorDespesaTotalDia($dia) {
        return (double) Despesa::find()->where(['YEAR(data)' => date('Y', strtotime($this->mes_ano)), 'MONTH(data)' => date('m', strtotime($this->mes_ano)), 'DAY(data)' => $dia])->sum('valor');
    }

    public function getValorDespesaTotalMes() {
        return (double) Despesa::find()->where(['YEAR(data)' => date('Y', strtotime($this->mes_ano)), 'MONTH(data)' => date('m', strtotime($this->mes_ano))])->sum('valor');
    }

    public function getLucroMensal($mes, $ano) {
        return $this->getTotalReceitas($mes, $ano) - $this->getTotalDespesas($mes, $ano);
    }

    public function getRetiradasProlabora($mes, $ano) {
        return (double) Retirada::find()->where(['YEAR(mes)' => $ano, 'MONTH(mes)' => $mes])->sum('valor_roberto + valor_juliana');
    }

    public function getRetiradaProlaboraRoberto($mes, $ano) {
        return (double) Retirada::find()->where(['YEAR(mes)' => $ano, 'MONTH(mes)' => $mes])->sum('valor_roberto');
    }

    public function getRetiradaProlaboraJuliana($mes, $ano) {
        return (double) Retirada::find()->where(['YEAR(mes)' => $ano, 'MONTH(mes)' => $mes])->sum('valor_juliana');
    }

    public function getSaldoMensal($mes, $ano) {
        return $this->getLucroMensal($mes, $ano) - $this->getRetiradasProlabora($mes, $ano);
    }

    public function getValorGrafico($categoria, $mes, $ano) {
        switch ($categoria) {
            case 0:
                return (double) $this->getComissaoJogos($mes, $ano);
                break;
            case 1:
                return (double) $this->getComissaoServicos($mes, $ano);
                break;
            case 2:
                return (double) $this->getTotalReceitas($mes, $ano);
                break;
            case 3:
                return (double) $this->getTotalDespesas($mes, $ano);
                break;
            case 4:
                return (double) $this->getLucroMensal($mes, $ano);
                break;
            case 5:
                return (double) $this->getRetiradasProlabora($mes, $ano);
                break;
            case 6:
                return (double) $this->getSaldoMensal($mes, $ano);
                break;
        }
    }

    public function getComissaoJogosAnual($ano) {
        return (double) Jogo::find()->where(['YEAR(data)' => $ano])->sum('valor');
    }

    public function getComissaoServicosAnual($ano) {
        return (double) Servico::find()->where(['YEAR(data)' => $ano])->sum('valor');
    }

    public function getRetiradasProlaboraAnual($ano) {
        return (double) Retirada::find()->where(['YEAR(mes)' => $ano])->sum('valor_roberto + valor_juliana');
    }

    public function getDespesasAnual($ano) {
        return (double) Despesa::find()->where(['YEAR(data)' => $ano])->sum('valor');
    }

    public function getReceitaAnual() {
        return (double) ($this->getComissaoJogosAnual($this->ano) + $this->getComissaoServicosAnual($this->ano));
    }

    public function getValorGraficoComissaoJogosGeral() {
        $receitaAnual = $this->getReceitaAnual($this->ano);
        $comissaoJogosAnual = $this->getComissaoJogosAnual($this->ano);
        return $receitaAnual != 0 ? (double) number_format($comissaoJogosAnual * 100 / $receitaAnual, 1) : (double) 0;
    }

    public function getValorGraficoComissaoServicosGeral() {
        $receitaAnual = $this->getReceitaAnual($this->ano);
        $comissaoServicosAnual = $this->getComissaoServicosAnual($this->ano);
        return $receitaAnual != 0 ? (double) number_format($comissaoServicosAnual * 100 / $receitaAnual, 1) : (double) 0;
    }

    public function getValorGraficoRetiradasProlaboraGeral() {
        $receitaAnual = $this->getReceitaAnual($this->ano);
        $retiradasProlabora = $this->getRetiradasProlaboraAnual($this->ano);
        return $receitaAnual != 0 ? (double) number_format($retiradasProlabora * 100 / $receitaAnual, 1) : (double) 0;
    }

    public function getValorGraficoDespesasGeral() {
        $receitaAnual = $this->getReceitaAnual($this->ano);
        $despesas = $this->getDespesasAnual($this->ano);
        return $receitaAnual != 0 ? (double) number_format($despesas * 100 / $receitaAnual, 1) : (double) 0;
    }
    
    public function getTotalDespesaPeriodo($categoriaID) {
        return (double) Despesa::find()->where(['categoria_id' => $categoriaID])->andWhere(['>=', 'DATE(data)', $this->periodo_inicial])->andWhere(['<=', 'DATE(data)', $this->periodo_final])->sum('valor');
    }
    
    public function getDataModal($dia, $mes, $ano, $periodoInicial, $periodoFinal) {
        if ($dia != NULL) {
            return date('d/m/Y', strtotime($ano . '/' . $mes . '/' . $dia));
        }
        
        if ($dia == NULL && $periodoInicial == NULL && $periodoFinal == NULL) {
            return $mes . '/' . $ano;
        }
        
        if ($periodoInicial != NULL && $periodoFinal != NULL) {
            return 'De ' . date('d/m/Y', strtotime($periodoInicial)) . ' Até ' . date('d/m/Y', strtotime($periodoFinal));
        }
        
        return 'X';
    }
    
}
