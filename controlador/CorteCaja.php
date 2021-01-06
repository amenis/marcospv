<?php

class  CorteCaja {

    private $db;
    private $session;

    public function __construct()
    {
        $this->db = new Modelo();
        $this->session = new Session();
    }

    public function index() {
        if( $this->session->get_session('userId')){
            view('corteCaja');
        } else{
            redirect();
        }
    }

    public function corte()
    {

        $ventas =  $this->db->custom('SELECT sum(total) as total FROM ventas where status !=1 AND fecha BETWEEN "' . $_POST['fecha_in'] . ' 00:00:00" AND "' . $_POST['fecha_end'] . ' 23_59:59"');
        $gastos = $this->db->custom('SELECT g.descripcion,g.cantidad,cat.descripcion FROM gastos g LEFT JOIN categoria cat on cat.id_categoria = g.id_categoria WHERE fecha BETWEEN "' . $_POST['fecha_in'] . ' 00:00:00" AND "' . $_POST['fecha_end'] . ' 23:59:59"');
        $abonos = $this->db->custom('SELECT sum(cantidad) as total FROM gastos WHERE fecha BETWEEN "' . $_POST['fecha_in'] . ' 00:00:00" AND "' . $_POST['fecha_end'] . ' 23_59:59"');
        $corte = 0;
        $file = fopen('corte.txt', 'w+');
        fputs($file, "         " . "\n");
        fputs($file, "CORTE DE CAJA             " . "\n");
        fputs($file, 'Fecha : ' . date('Y-m-d H:i:s') . "\n");
        fputs($file, 'Empleado: ' . $this->session->get_session('userName') . "\n\n");
        fputs($file, "----------------------------------\n\n");
        
        fputs($file, 'Ventas del dia                        ' . "\n\n");
        fputs($file, 'Total         ' . $ventas[0]['total'] . "\n");
        fputs($file, "----------------------------------\n\n");
               
        fputs($file, 'Cuenta de Abono                        ' . "\n\n");
        fputs($file, 'Total         ' . $abonos[0]['total'] . "\n");
        fputs($file,"----------------------------------\n\n");

        fputs($file, 'Cuenta de Gastos                       ' . "\n\n");
        foreach($gastos as $g) {
            fputs($file, $g['descripcion']."        ",13);
            fputs($file, $g['cantidad']."\n");
            $corte = intval($corte) + intval($g['cantidad']);            
        }
        fputs($file,"----------------------------------\n\n");
        fputs($file,"Corte                          "."\n\n");
        fputs($file,"Total:       ".( intval($ventas[0]['total']) - $corte ),18);
      
    }

}