<?php
require_once __DIR__ . "/../modelo/pelicula.php";
require_once __DIR__ . "/../modelo/peliculaDao.php";

class PeliculaController
{
    private $dao;

    public function __construct($dao)
    {
        $this->dao = $dao;
    }

    public function index()
    {
        $peliculas = $this->dao->listar();
        require __DIR__ . "/../vista/Peliculas/index.php";
    }

    public function nuevo()
    {
        $pelicula = new Pelicula();
        require __DIR__ . "/../vista/Peliculas/formulario.php";
    }

    public function guardar()
    {
        $pelicula = $this->crearPeliculaDesdeFormulario();
        $this->dao->insertar($pelicula);
        header("Location: index.php");
        exit;
    }

    public function editar()
    {
        $pelicula = $this->dao->buscarPorId($_GET["id"] ?? null);
        if ($pelicula === null) {
            http_response_code(404);
            exit("Película no encontrada.");
        }

        require __DIR__ . "/../vista/Peliculas/formulario.php";
    }

    public function actualizar()
    {
        $pelicula = $this->crearPeliculaDesdeFormulario();
        $pelicula->setId($_POST["id"] ?? null);
        $this->dao->actualizar($pelicula);
        header("Location: index.php");
        exit;
    }

    public function eliminar()
    {
        $this->dao->eliminar($_GET["id"] ?? null);
        header("Location: index.php");
        exit;
    }

    private function crearPeliculaDesdeFormulario()
    {

        $duracion = filter_var($_POST["duracion"] ?? "", FILTER_VALIDATE_INT);
        if ($duracion === false || $duracion < 0 || $duracion > 2147483647 || mb_strlen($_POST["nombre"] ?? "", "UTF-8") > 100 || mb_strlen($_POST["genero"] ?? "", "UTF-8") > 50 || mb_strlen($_POST["imagenportada"] ?? "", "UTF-8") > 255) {
            http_response_code(422);
            exit("Revisa la duración y la longitud de los campos de la película.");
        }
        return new Pelicula(
            null,
            $_POST["nombre"] ?? "",
            $_POST["genero"] ?? "",
            $duracion,
            $_POST["imagenportada"] ?? ""
        );
    }
}
