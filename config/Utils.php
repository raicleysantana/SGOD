<?php


class Utils
{

    public function situacao($valor)
    {
        $output = "";

        if ($valor === '1')
            $output = '<span class="text-success">Ativo</span>';
        else
            $output = '<span class="text-danger">Inativo</span>';

        return $output;
    }

    public static function getSituacao()
    {
        return [
            '1' => 'Ativo',
            '0' => 'Inativo'
        ];
    }

    public static function getPeriodo()
    {
        return [
            'MANHA' => 'Manhã',
            'TARDE' => 'Tarde',
            'NOITE' => 'Noite'
        ];
    }

    public static function periodo($periodo)
    {
        $data = self::getSituacao();
        return $data[$periodo] ?: 'Não definido';
    }
}
