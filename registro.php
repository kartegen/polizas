<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exportar tabla HTML a Excel</title>
        <script src="./js/xlsx.full.min.js"></script>
        <script src="./js/FileSaver.min.js"></script>
        <script src="./js/tableexport.min.js"></script>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <h1>Tabla HTML a Excel</h1>
        <p>
            Exportar los datos de una tabla de una p�gina web a una hoja de
            c�lculo
            de Excel
            <br>
            <a href="//parzibyte.me/blog">By Parzibyte</a>
        </p>
        <button id="btnExportar">Exportar</button>
        <br>
        <br>
        <table id="tabla">
            <thead>
                <tr>
                    <th>Lenguaje</th>
                    <th>Sitio web</th>
                    <th>Algunos usos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PHP</td>
                    <td>php.net</td>
                    <td>Aplicaciones web</td>
                </tr>
                <tr>
                    <td>Python</td>
                    <td>python.org</td>
                    <td>Aplicaciones web y de escritorio. Machine learning</td>
                </tr>
                <tr>
                    <td>Go</td>
                    <td>golang.org</td>
                    <td>Aplicaciones web y de escritorio</td>
                </tr>
            </tbody>
        </table>
        <script src="./js/script.js"></script>
    </body>
</html>