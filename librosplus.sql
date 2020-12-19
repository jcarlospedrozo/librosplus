-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2020 a las 04:17:46
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `librosplus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `idAdministrador` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `usuario` text NOT NULL,
  `contrasena` text NOT NULL,
  `perfil` text NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`idAdministrador`, `nombre`, `usuario`, `contrasena`, `perfil`, `estado`, `fecha`) VALUES
(1, 'Libros Plus', 'librosplus', '$2a$07$asxx54ahjppf45sd87a5aulRWzYf2RyMnhIiXNZjwUJzTAbLr4hfi', 'Administrador', 1, '2020-10-24 05:17:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `idAutor` int(11) NOT NULL,
  `nombreAutor` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`idAutor`, `nombreAutor`) VALUES
(1, 'Gabriel Garcia Marquez'),
(3, 'Patrick Suskind'),
(4, 'Jane Austen'),
(5, 'Andrés Oppenheimer'),
(6, 'J. J. R. Tolkien'),
(7, 'Anónimo'),
(11, 'George R. R. Martin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `rutaCategoria` text NOT NULL,
  `nombreCategoria` text DEFAULT NULL,
  `imagenCategoria` text DEFAULT NULL,
  `fechaCategoria` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `rutaCategoria`, `nombreCategoria`, `imagenCategoria`, `fechaCategoria`) VALUES
(1, 'literatura-universal', 'Literatura Universal', 'views/img/literatura universal/portada.png', '2020-11-30 02:33:14'),
(2, 'literatura-colombiana', 'Literatura Colombiana', 'views/img/literatura colombiana/portada.png', '2020-11-30 02:33:38'),
(12, 'otros', 'Otros', 'views/img/otros/portada.png', '2020-11-30 02:33:47'),
(21, 'ficcion', 'Ficcion', 'views/img/ficcion/portada.png', '2020-12-04 02:22:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `idLibro` int(11) NOT NULL,
  `nombreLibro` varchar(45) DEFAULT NULL,
  `descripcionLibro` text NOT NULL,
  `fotoLibro` text DEFAULT NULL,
  `precioLibro` float NOT NULL,
  `fechaLibro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idCategoria` int(11) DEFAULT NULL,
  `idAutor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`idLibro`, `nombreLibro`, `descripcionLibro`, `fotoLibro`, `precioLibro`, `fechaLibro`, `idCategoria`, `idAutor`) VALUES
(1, 'Orgullo y Prejuicio', '<p>En una época marcada por profundos cambios sociales, económicos, políticos. Tales como la Revolución francesa, la Revolución industrial, las campañas napoleónicas. Los conflictos de la clase burgués con la clase baja o media. Los avances europeos en el campo de las ciencias, la extensión del imperio británico, la llegada de la modernidad. Jane Austen vivió en los tiempos de la regencia, entre el período georgiano y el victoriano. En sus obras describe con total precisión la sociedad rural georgiana. Con una pluma elegante la autora nos relata detalles, costumbres, sentimientos, describe diálogos, nos sumerge al siglo XIX.</p>', 'views/img/literatura universal/orgullo y prejuicio.png', 10000, '2020-11-30 02:28:00', 1, 4),
(2, 'El Perfume', '<p>Jean Baptiste Grenouille es, gracias a su prodigioso sentido del olfato, el mejor elaborador de perfumes de todos los tiempos, pero es un ser grotesco, deforme y repulsivo ante los ojos de las mujeres. Como venganza a tanta ofensa sufrida a causas de su aspecto físico elabora un raro perfume que subyaga la voluntad de quien lo huele. Así, Jean Baptiste Grenouille consigue el favor de las damas de la alta sociedad y el dominio de los poderosos. Existe un único problema: para conseguir la esencia elemental de la mágica fragancia se necesitan los fluidos corporales de jovencitas vírgenes, y para ello el perfumista no duda en convertirse en un obsesivo, cruel y despiadado asesino.</p>', 'views/img/literatura universal/el perfume.png', 10000, '2020-11-30 02:28:11', 1, 3),
(3, 'Cien Años de Soledad', '<p>«Muchos años después, frente al pelotón de fusilamiento, el coronel Aureliano Buendía había de recordar aquella tarde remota en que su padre lo llevó a conocer el hielo.» Con estas palabras empieza una novela legendaria, una de las aventuras literarias más fascinantes del siglo XX. La familia Buendía-Iguarán, con sus milagros, fantasías, obsesiones, tragedias, incestos, adulterios, rebeldías, descubrimientos y condenas, representa al mismo tiempo el mito y la historia, la tragedia y el amor del mundo entero.</p>', 'views/img/literatura colombiana/cien años de soledad.png', 11000, '2020-11-30 02:28:19', 2, 1),
(5, 'Las Mil y Una Noches', '<p>Desde su aparición en Francia en el siglo XVIII las legendarias narraciones de Las mil y una noches, sedujeron a Europa a quien fuertemente atraída por esta literatura, prácticamente desconocida hasta entonces, descubrió la existencia de un lejano Oriente hechicero, seductor, enigmático, lleno de sorpresas y que postulaba en esencia una manera completamente distinta de ver y sentir el mundo: genios, magos, tesoros incalculables, palabras mágicas, viajes a países exóticos y búsqueda de lugares mágicos.</p>', 'views/img/Literatura Universal/las mil y una noches.png', 12000, '2020-11-23 23:43:07', 1, 7),
(11, 'Cronica de una muerte anunciada', '<p>La obra más realista de Gabriel García Márquez basado en un hecho histórico acontecido en la tierra natal de escritor. El día en que lo iban a matar, Santiago Nasar se levantó a las 5.30 de la mañana para esperar el buque en que llegaba el obispo. Había soñado que atravesaba un bosque de higuerones donde caía una llovizna tierna, y por un instante fue feliz en el sueño, pero al despertar se sintió por completo salpicado de cagada de pájaros</p>', 'views/img/literatura colombiana/cronica de una muerte anunciada.png', 10000, '2020-11-30 02:29:14', 2, 1),
(48, 'Crear o Morir', '<p>Con un sorprendente optimismo sobre el futuro de América Latina, Andrés Oppenheimer revela en este libro las claves del éxito en el siglo xxi, en que la innovación y la creatividad serán los pilares del progreso. &nbsp;¿Qué debemos hacer como personas y países para avanzar en la economía de la innovación? ¿Qué debemos hacer para producir innovadores de talla mundial, como Steve Jobs? Para averiguarlo, Oppenheimer -el periodista latinoamericano más galardonado a escala internacional- explora los secretos de las brillantes trayectorias de varios innovadores en la actualidad.</p>', 'views/img/otros/crear o morir.jpg', 11000, '2020-12-03 04:43:56', 12, 5),
(59, 'Juego de Tronos - I cancion de hielo y fuego', '<p>El legendario mundo de los Siete Reinos donde el verano puede durar décadas y el invierno toda una vida, y donde rastros de una magia inmemorial surgen en los rincones más sombríos, la tierra del norte, invernalia, esta reguardada por un colosal muro de hielo que tiene a fuerzas oscuras y sobre naturales. Este majestuoso escenario, Lord Stark y su familia se encuentran en el centro de un conflicto que desatara todas las pasiones: la traición y la lealtad, la compasión y la sed de venganza, el amor y el poder, la lujuria y el incesto, todo ello para ganar la más mortal de las batallas: el trono de hierro, una poderosa trampa que atrapare a los personajes.</p>', 'views/img/ficcion/juego de tronos - i cancion de hielo y fuego.png', 12000, '2020-12-04 02:24:10', 21, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `idNotificacion` int(11) NOT NULL,
  `reservas` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fechaNotificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`idNotificacion`, `reservas`, `cantidad`, `fechaNotificacion`) VALUES
(1, 'reservas', 0, '2020-12-04 01:44:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idReserva` int(11) NOT NULL,
  `idLibro` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `pagoReserva` float DEFAULT NULL,
  `transaccionReserva` text NOT NULL,
  `codigoReserva` varchar(20) DEFAULT NULL,
  `fechaDespacho` date DEFAULT NULL,
  `fechaDevolucion` date DEFAULT NULL,
  `fechaReserva` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idReserva`, `idLibro`, `idUsuario`, `pagoReserva`, `transaccionReserva`, `codigoReserva`, `fechaDespacho`, `fechaDevolucion`, `fechaReserva`) VALUES
(15, 11, 9, 10000, '1231628191', '5ANCL48WN', '0000-00-00', '0000-00-00', '2020-11-28 03:20:53'),
(17, 2, 10, 10000, '1231712242', '5FSMX1FZB', '2020-12-05', '2020-12-28', '2020-12-03 22:57:49'),
(19, 48, 1, 11000, '1231711732', 'ELBCM4LI9', '2020-11-18', '2020-12-07', '2020-12-03 23:38:30'),
(20, 48, 10, 11000, '1231712448', '1ESOTUJN9', '2020-12-29', '2021-01-20', '2020-12-04 02:27:12'),
(22, 1, 16, 10000, '1231714139', 'QMHT9Q7EU', '0000-00-00', '0000-00-00', '2020-12-04 02:26:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(45) DEFAULT NULL,
  `emailUsuario` text DEFAULT NULL,
  `contrasenaUsuario` text DEFAULT NULL,
  `fotoUsuario` text DEFAULT NULL,
  `modoUsuario` text NOT NULL,
  `verificacion` int(11) NOT NULL,
  `emailEncriptado` text NOT NULL,
  `fechaUsuario` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreUsuario`, `emailUsuario`, `contrasenaUsuario`, `fotoUsuario`, `modoUsuario`, `verificacion`, `emailEncriptado`, `fechaUsuario`) VALUES
(1, 'Jean Carlos Pedrozo', 'jeancapedrozo@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aulEjws4PqvE4M0Fy7azV5BDjJ6OcUNw6', '', 'directo', 1, 'ca1fc5d915377d5652904b22c224bb66', '2020-10-18 17:35:14'),
(7, 'pedro picapiedra', 'pedropicapiedra@hotmail.com', '$2a$07$asxx54ahjppf45sd87a5auu9A3RtAdCY7RzUSQxmlnMdP2pbEkSCq', '', 'directo', 1, 'cf4a033ca4e11f2706d97381c5fd3c92', '2020-11-26 19:47:38'),
(9, 'martin pedrozo', 'martinpedrozo@hotmail.com', '$2a$07$asxx54ahjppf45sd87a5ausaPpnlo9JWmvfd7evJc0A/0NLOliEJC', '', 'directo', 1, '29da8df10ec3413a0c939420fe7c0e24', '2020-11-26 18:45:57'),
(10, 'delcy lazaro', 'delcylazaro@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aub8U4mHaAH0L1W7VpOhEbNSXxPv.BRr6', '', 'directo', 1, '67f27ebbaef2363a6916f65ef25e7766', '2020-12-03 22:52:47'),
(16, 'Libros Plus', 'librosplus@outlook.com', 'null', 'http://graph.facebook.com/104472138115242/picture?type=large', 'facebook', 1, 'null', '2020-12-04 02:15:43');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`idAdministrador`);

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`idAutor`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`idLibro`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `idAutor` (`idAutor`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idNotificacion`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `idLibro` (`idLibro`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `idAutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `idLibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `idNotificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`),
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`idAutor`) REFERENCES `autores` (`idAutor`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idLibro`) REFERENCES `libros` (`idLibro`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
