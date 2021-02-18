-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-02-2021 a las 04:39:35
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendavirtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `categoria_principal_id` int(11) DEFAULT NULL,
  `categoria_nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `categoria_activa` tinyint(1) DEFAULT NULL,
  `categoria_meta_link` varchar(100) DEFAULT NULL,
  `categoria_creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categoria_modificado` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `categoria_principal_id`, `categoria_nombre`, `categoria_activa`, `categoria_meta_link`, `categoria_creado`, `categoria_modificado`) VALUES
(1, 1, 'Diario', 1, 'diario', '2021-02-14 08:26:41', '2021-02-14 08:26:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_principal`
--

CREATE TABLE `categorias_principal` (
  `categoria_principal_id` int(11) NOT NULL,
  `categoria_principal_nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `categoria_principal_activa` tinyint(1) DEFAULT NULL,
  `categoria_principal_meta_link` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `categoria_principal_creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categoria_principal_data_modificado` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias_principal`
--

INSERT INTO `categorias_principal` (`categoria_principal_id`, `categoria_principal_nombre`, `categoria_principal_activa`, `categoria_principal_meta_link`, `categoria_principal_creado`, `categoria_principal_data_modificado`) VALUES
(1, 'Colegios', 1, 'colegios', '2021-02-14 07:26:42', '2021-02-14 07:26:42'),
(2, 'Deportivos', 1, 'deportivos', '2021-02-14 08:13:14', '2021-02-14 08:13:14'),
(3, 'Medicos', 1, 'medicos', '2021-02-17 17:49:35', '2021-02-17 17:49:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrador'),
(2, 'cliente', 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE `lineas` (
  `linea_id` int(11) NOT NULL,
  `linea_nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `linea_meta_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `linea_activa` tinyint(1) DEFAULT NULL,
  `linea_creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `linea_modificado` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lineas`
--

INSERT INTO `lineas` (`linea_id`, `linea_nombre`, `linea_meta_link`, `linea_activa`, `linea_creado`, `linea_modificado`) VALUES
(1, 'Uniformes', 'uniformes', 1, '2021-02-14 05:20:24', '2021-02-17 17:48:03'),
(3, 'Pijamas', 'pijamas', 1, '2021-02-17 17:49:44', NULL),
(4, 'Bebes', 'bebes', 1, '2021-02-17 17:49:53', NULL),
(5, 'Dotaciones', 'dotaciones', 1, '2021-02-17 17:50:01', NULL),
(6, 'Particular', 'particular', 1, '2021-02-17 17:50:07', NULL),
(7, 'Mascotas', 'mascotas', 1, '2021-02-17 17:50:13', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(11) NOT NULL,
  `producto_codigo` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `producto_fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `producto_categoria_id` int(11) DEFAULT NULL,
  `producto_marca_id` int(11) DEFAULT NULL,
  `producto_nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `producto_meta_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `producto_talla` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0',
  `producto_peso` int(11) DEFAULT '0',
  `producto_altura` int(11) DEFAULT '0',
  `producto_ancho` int(11) DEFAULT '0',
  `producto_largo` int(11) DEFAULT '0',
  `producto_color` text NOT NULL,
  `producto_valor` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `producto_destacado` tinyint(1) DEFAULT NULL,
  `producto_controlar_stock` tinyint(1) DEFAULT NULL,
  `producto_cantidad_stock` int(11) DEFAULT '0',
  `producto_activo` tinyint(1) DEFAULT NULL,
  `producto_descripcion` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `producto_fecha_modificacion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `producto_codigo`, `producto_fecha_registro`, `producto_categoria_id`, `producto_marca_id`, `producto_nombre`, `producto_meta_link`, `producto_talla`, `producto_peso`, `producto_altura`, `producto_ancho`, `producto_largo`, `producto_color`, `producto_valor`, `producto_destacado`, `producto_controlar_stock`, `producto_cantidad_stock`, `producto_activo`, `producto_descripcion`, `producto_fecha_modificacion`) VALUES
(1, '123456', '2021-02-15 04:46:11', 1, 1, 'Producto de prueba', 'producto-de-prueba', NULL, 1, 10, 10, 10, '', '2500', 1, 1, 1, 1, 'adsfsañldf aidfopaidf aosdfyaouihdfopauhf adeyfopasduyfaopu fasdyfpoasduifpasdf ', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_fotos`
--

CREATE TABLE `productos_fotos` (
  `foto_id` int(11) NOT NULL,
  `foto_producto_id` int(11) DEFAULT NULL,
  `foto_ruta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistema`
--

CREATE TABLE `sistema` (
  `sistema_id` int(11) NOT NULL,
  `sistema_razon_social` varchar(145) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sistema_nombre` varchar(145) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sistema_nit` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sistema_telefono_fijo` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sistema_telefono_movil` varchar(25) NOT NULL,
  `sistema_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sistema_sitio_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sistema_postal` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sistema_direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sistema_barrio` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sistema_ciudad` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sistema_departamento` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sistema_productos_destacados` int(11) NOT NULL,
  `sistema_texto` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `sistema_fecha_modificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sistema`
--

INSERT INTO `sistema` (`sistema_id`, `sistema_razon_social`, `sistema_nombre`, `sistema_nit`, `sistema_telefono_fijo`, `sistema_telefono_movil`, `sistema_email`, `sistema_sitio_url`, `sistema_postal`, `sistema_direccion`, `sistema_barrio`, `sistema_ciudad`, `sistema_departamento`, `sistema_productos_destacados`, `sistema_texto`, `sistema_fecha_modificacion`) VALUES
(1, 'Confecciones Salamandra', 'Salamandra Virtual', '800256415-8', '(1) 867-4616', '310 256-3210', 'info@confeccionessalamandra.com', 'http://www.confeccionessalamandra.com', '', 'carrera 6 #11-75', 'Centro', 'Fusagasugá', 'Cundinamarca', 6, 'Precio y calidad insuperables!', '2021-02-10 05:45:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(3, '::1', 'osbeltran', '$2y$10$omeuScoHbHk23GIkSwBRw.UNdFK97fgLJEJlSqbRvh6ClPGC8ghfK', 'administrador@confeccionessalamandra.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1612846725, 1613614957, 1, 'Oscar', 'Beltran', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(19, 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`),
  ADD KEY `categoria_principal_id` (`categoria_principal_id`);

--
-- Indices de la tabla `categorias_principal`
--
ALTER TABLE `categorias_principal`
  ADD PRIMARY KEY (`categoria_principal_id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`linea_id`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `producto_categoria_id` (`producto_categoria_id`),
  ADD KEY `producto_marca_id` (`producto_marca_id`);

--
-- Indices de la tabla `productos_fotos`
--
ALTER TABLE `productos_fotos`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `fk_foto_producto_id` (`foto_producto_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indices de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categorias_principal`
--
ALTER TABLE `categorias_principal`
  MODIFY `categoria_principal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `lineas`
--
ALTER TABLE `lineas`
  MODIFY `linea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos_fotos`
--
ALTER TABLE `productos_fotos`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categoria_principal_id` FOREIGN KEY (`categoria_principal_id`) REFERENCES `categorias_principal` (`categoria_principal_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `productos_fotos`
--
ALTER TABLE `productos_fotos`
  ADD CONSTRAINT `fk_foto_producto_id` FOREIGN KEY (`foto_producto_id`) REFERENCES `productos` (`producto_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
