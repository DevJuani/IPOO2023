<?php
class Viaje {

    //Atributos
    private $viaje;
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    private $pasajeros;
    
    //Métodos
    public function __construct(){
        $this->menuPrincipal();
    }

/** -------------------Setters--------------------------- */
    /**
     * Establece el arreglo viaje
     */
    public function setViaje($viaje){
        $this->viaje = $viaje;
    }
    /**
     * Establece el valor del código de viaje
     */
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    /**
     * Establece el destino del viaje
     */
    public function setDestino($destino){
        $this->destino = $destino;
    }
    /**
     * Establece la cantidad máxima de pasajeros
     */
    public function setCantMaxPasajeros($cantMaxPasajeros){
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }
    /**
     * Establece el arreglo pasajeros
     */
    public function setPasajeros($pasajeros){
        $this->pasajeros = $pasajeros;
    }
/** ----------------------------------------------------- */

/** -----------------------Getters----------------------- */
    /**
     * Devuelve el arreglo que contiene la información del viaje
     */
    public function getViaje(){
        return $this->viaje;
    }
    /**
     * Devuelve el código del viaje
     */
    public function getCodigo(){
        return $this->codigo;
    }
    /**
     * Devuelve el destino del viaje
     */
    public function getDestino(){
        return $this->destino;
    }
    /**
     * Devuelve la cantidad máxima de pasajeros
     */
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }
    /**
     * Devuelve el arreglo que contiene la información de los pasajeros
     */
    public function getPasajeros(){
        return $this->pasajeros;
    }
/** ------------------------------------------------------- */

    /**
     * Funcíon para cargar información del viaje
     */
    public function cargarviaje(){
        //String unNombre, unApellido, unDestino, seguir   
        //Array arregloViaje, arregloPasajeros, unPasajero
        //Int unaCantMaxPasajeros, unCodigo, unDni, i 
        $seguir = "S";
        $i = 0;
        $arregloPasajeros = [];
        echo "Ingrese el código del viaje: \n";
        $unCodigo = trim(fgets(STDIN));
        while ($this->existeCodigoViaje($unCodigo)) {
            echo "El código ingresado ya existe. Ingrese otro: \n";
            $unCodigo = trim(fgets(STDIN));
        }
        echo "Ingrese el destino del viaje: \n";
        $unDestino = trim(fgets(STDIN));
        echo "Ingrese la cantidad máxima de pasajeros que tendra el viaje: \n";
        $unaCantMaxPasajeros = trim(fgets(STDIN));
        while (($seguir == "S" || $seguir = "s") && $i < $unaCantMaxPasajeros) { 
            echo "Ingrese el nombre del pasajero N° :" . $i+1 . ".\n";
            $unNombre = trim(fgets(STDIN));
            echo "Ingrese el apellido: \n";
            $unApellido = trim(fgets(STDIN));
            echo "Ingrese el DNI: \n";
            $unDni = trim(fgets(STDIN));
            $unPasajero = ["Nombre" => $unNombre, "Apellido" => $unApellido, "DNI" => $unDni];
            $arregloPasajeros[$i] = $unPasajero;
            $i++;
            if ($i < $unaCantMaxPasajeros) {
                echo "¿Desea ingresar otro pasajero? S/N.\n";
                $seguir = trim(fgets(STDIN));
            } else echo "Se ha alcanzado el límite de pasajeros.\n";
        }
        $arregloViaje = ["Código" => $unCodigo, "Destino" => $unDestino, "Cantidad máxima de pasajeros" => $unaCantMaxPasajeros, "Pasajeros" => $arregloPasajeros];
        $this->setViaje($arregloViaje);
        $this->setCodigo($unCodigo);
        $this->setDestino($unDestino);
        $this->setCantMaxPasajeros($unaCantMaxPasajeros);
        $this->setPasajeros($arregloPasajeros);
        echo "Información guardada.\n";
    }

    /** Verifica si el código de viaje ya existe */
    //String codigo
    //Array viaje
    //Boolean existe
    public function existeCodigoViaje($codigo) {
        $viaje = $this->getViaje();
        if ($viaje && $viaje['Código'] == $codigo) {
            return true;
        } else {
            return false;
        }
    }    

    /**
     * Le permite al usuario editar secciones del viaje
     */
    public function editarViaje(){
        //Array mViaje, mPasajeros, mPasajero
        //String mDestino, mNombre, mApellido
        //Int respuesta, mCodigo, mCantMaxPasajeros, nPasajero, mDni
        //Boolean encontrado
        $mViaje = $this->getViaje();
        do {
            $this->menuEdicion();
            $respuesta = trim(fgets(STDIN));
            switch ($respuesta) {
                case 1:
                    echo "Ingrese el nuevo código de viaje.\n";
                    $mCodigo = trim(fgets(STDIN));
                    $mViaje["Código"] = $mCodigo;
                    $this->setViaje($mViaje);
                    $this->setCodigo($mCodigo);
                    echo "Datos guardados.\n";
                    break;
                case 2:
                    echo "Ingrese el nuevo destino del viaje.\n";
                    $mDestino = trim(fgets(STDIN));
                    $mViaje["Destino"] = $mDestino;
                    $this->setViaje($mViaje);
                    $this->setDestino($mDestino);
                    echo "Datos guardados.\n";
                    break;
                case 3:
                    echo "Ingrese la nueva cantidad máxima de pasajeros.\n";
                    $mCantMaxPasajeros = trim(fgets(STDIN));
                    $mViaje["Cantidad máxima de pasajeros"] = $mCantMaxPasajeros;
                    $this->setViaje($mViaje);
                    $this->setCantMaxPasajeros($mCantMaxPasajeros);
                    echo "Datos guardados.\n";
                    break;
                case 4:
                    $encontrado = false;
                    do {
                        echo "Ingrese el número de pasajero que desea editar.\n";
                        $nPasajero = trim(fgets(STDIN)) - 1;
                        if (array_key_exists($nPasajero, $mViaje["Pasajeros"])) {
                            $mPasajeros = $this->getPasajeros();
                            $encontrado = true;
                            echo "Ingrese el nuevo nombre del pasajero.\n";
                            $mNombre = trim(fgets(STDIN));
                            echo "Ingrese el nuevo apellido.\n";
                            $mApellido = trim(fgets(STDIN));
                            echo "Ingrese el nuevo DNI.\n";
                            $mDni = trim(fgets(STDIN));
                            $mPasajero = ["Nombre" => $mNombre, "Apellido" => $mApellido, "DNI" => $mDni];
                            $mPasajeros[$nPasajero] = $mPasajero;
                            $mViaje["Pasajeros"] = $mPasajeros;
                            $this->setViaje($mViaje);
                            $this->setPasajeros($mPasajeros);
                            echo "Datos guardados.\n";
                        } else echo "ERROR, ingrese un número de pasajero existente.\n";
                    } while (!$encontrado);
                    break;
                case 5:
                    break;
                default:
                    echo "ERROR, ingrese una opción válida";
            }
        } while ($respuesta != 5);
        echo "/---------------------------/\n";
    }

    /**
     * Muestra información del viaje
     */
    public function mostrarDatos(){
        //Array arrayPasajeros
        //Int i, j
        $arrayPasajeros = $this->getPasajeros();
        $j = count($arrayPasajeros);
        echo "Información del viaje N°" . $this->getCodigo() . ".\n";
        echo "Destino: " . $this->getDestino() . "\n";
        echo "Cantidad máxima de pasajeros: " . $this->getCantMaxPasajeros() . "\n";
        echo "Datos de los pasajeros:\n";
        for ($i = 0; $i < $j; $i++) {
            echo "Pasajero N°" . $i+1 . "\n";
            echo "Nombre: " . $arrayPasajeros[$i]["Nombre"] . "\n";
            echo "Apellido: " . $arrayPasajeros[$i]["Apellido"] . "\n";
            echo "DNI: " . $arrayPasajeros[$i]["DNI"] . "\n";
            echo "/---------------------------/\n";
        }
    }

    /**
     * Menú principal
     */
    public function mostrarMenu(){
        $mensaje = "Bienvenido al programa de registro de datos Viaje Feliz\n";
        $mensaje .= "Por favor seleccione una opción:\n";
        $mensaje .= "1. Cargar información del viaje\n";
        $mensaje .= "2. Editar información del viaje\n";
        $mensaje .= "3. Visualizar información del viaje\n";
        $mensaje .= "4. Salir de la aplicación\n";
        echo $mensaje;
    }
    

    /**
     * Menú de edición de datos del viaje
     */
    public function menuEdicion(){
            echo "¿Qué dato del viaje desea editar?\n";
            echo "1. Código\n";
            echo "2. Destino\n";
            echo "3. Cantidad máxima de pasajeros\n";
            echo "4. Un pasajero\n";
            echo "5. Volver al menú principal\n";
    }

    /**
     * Menú principal del programa
     */
    public function menuPrincipal(){
        //Boolean datosCargados
        //Int respuesta
        $datosCargados = false;
        do {
            $this->mostrarMenu();
            $respuesta = trim(fgets(STDIN));
            switch ($respuesta) {
                case 1:
                    $this->cargarviaje();
                    $datosCargados = true;
                    break;
                case 2:
                    $this->editarViaje();
                    break;
                case 3:
                    if ($datosCargados) {
                        $this->mostrarDatos();
                    } else echo "No hay datos cargados.\n";
                    break;
                case 4:
                    echo "Gracias por utilizar los servicios de Viaje Feliz.\n";
                    break;
                default:
                    echo "Ingrese una opción válida.\n";
                    break;
            }
        } while ($respuesta != 4);
    }
}