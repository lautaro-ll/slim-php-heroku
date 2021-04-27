
/* LEMOS LAUTARO LUCAS */
DELETE FROM producto;
DELETE FROM usuario;
DELETE FROM venta;

INSERT INTO `producto`(`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES (1001,77900361,'Westmacott','liquido',33,15.87,'2021-02-09','2020-09-26');
INSERT INTO `producto`(`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES (1002,77900362,'Spirit','solido',45,69.74,'2020-09-18','2020-04-14');
INSERT INTO `producto`(`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES (1003,77900363,'Newgrosh','polvo',14,68.19,'2020-11-29','2021-02-11');
INSERT INTO `producto`(`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES (1004,77900364,'McNickle','polvo',19,53.51,'2020-11-28','2020-04-17');
INSERT INTO `producto`(`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES (1005,77900365,'Hudd','solido',68,26.56,'2020-12-19','2020-06-19');
INSERT INTO `producto`(`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES (1006,77900366,'Schrader','polvo',17,96.54,'2020-08-02','2020-04-18');
INSERT INTO `producto`(`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES (1007,77900367,'Bachellier','solido',59,69.17,'2021-01-30','2020-06-07');
INSERT INTO `producto`(`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES (1008,77900368,'Fleming','solido',38,66.77,'2020-10-26','2020-10-03');
INSERT INTO `producto`(`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES (1009,77900369,'Hurry','solido',44,43.01,'2020-07-04','2020-05-30');
INSERT INTO `producto`(`id`, `codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creacion`, `fecha_de_modificacion`) VALUES (1010,77900310,'Krauss','polvo',73,35.73,'2021-03-03','2020-08-30');

INSERT INTO `usuario`(`id`, `nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) VALUES (101,'Mariano','Kautor',123456,'dkantor0@example.com','2021-01-07','Quilmes');
INSERT INTO `usuario`(`id`, `nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) VALUES (102,'German','Gerram',123456,'ggerram1@hud.gov','2020-05-08','Berazategui');
INSERT INTO `usuario`(`id`, `nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) VALUES (103,'Deloris','Fosis',123456,'bsharpe2@wisc.edu','2020-11-28','Avellaneda');
INSERT INTO `usuario`(`id`, `nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) VALUES (104,'Brok','Neiner',123456,'bblazic3@desdev.cn','2020-12-08','Quilmes');
INSERT INTO `usuario`(`id`, `nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) VALUES (105,'Garrick','Brent',123456,'gbrent4@theguardian.com','2020-12-17','Moron');
INSERT INTO `usuario`(`id`, `nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) VALUES (106,'Bili','Baus',123456,'bhoff5@addthis.com','2020-11-27','Moreno');

INSERT INTO `venta`(`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES (1,1001,101,2,'2020-07-19');
INSERT INTO `venta`(`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES (2,1008,102,3,'2020-08-16');
INSERT INTO `venta`(`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES (3,1007,102,4,'2021-01-24');
INSERT INTO `venta`(`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES (4,1006,103,5,'2021-01-14');
INSERT INTO `venta`(`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES (5,1003,104,6,'2021-03-20');
INSERT INTO `venta`(`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES (6,1005,105,7,'2021-02-22');
INSERT INTO `venta`(`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES (7,1003,104,6,'2020-12-02');
INSERT INTO `venta`(`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES (8,1003,106,6,'2020-06-10');
INSERT INTO `venta`(`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES (9,1002,106,6,'2021-02-04');
INSERT INTO `venta`(`id`, `id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) VALUES (10,1001,106,1,'2020-05-17');

--1. Obtener los detalles completos de todos los usuarios, ordenados alfabéticamente.
SELECT * FROM usuario ORDER BY apellido ASC;

--2. Obtener los detalles completos de todos los productos líquidos.
SELECT * FROM producto WHERE tipo = 'liquido';

--3. Obtener todas las compras en los cuales la cantidad esté entre 6 y 10 inclusive.
SELECT * FROM venta WHERE cantidad BETWEEN 6 AND 10;

--4. Obtener la cantidad total de todos los productos vendidos.
SELECT SUM(cantidad) FROM venta;

--5. Mostrar los primeros 3 números de productos que se han enviado.
SELECT codigo_de_barra FROM producto INNER JOIN venta ON producto.id=venta.id_producto LIMIT 3;

--6. Mostrar los nombres del usuario y los nombres de los productos de cada venta.
SELECT usuario.nombre,producto.nombre FROM venta INNER JOIN usuario ON venta.id_usuario=usuario.id INNER JOIN producto ON venta.id_producto=producto.id

--7. Indicar el monto (cantidad * precio) por cada una de las ventas.
SELECT ROUND(producto.precio*venta.cantidad,2) FROM venta INNER JOIN producto ON venta.id_producto=producto.id

--8. Obtener la cantidad total del producto 1003 vendido por el usuario 104.
SELECT SUM(cantidad) FROM venta WHERE id_producto=1003 AND id_usuario=104

--9. Obtener todos los números de los productos vendidos por algún usuario de ‘Avellaneda’.
SELECT producto.codigo_de_barra,usuario.localidad FROM venta INNER JOIN producto ON venta.id_producto=producto.id INNER JOIN usuario ON venta.id_usuario=usuario.id WHERE usuario.localidad='Avellaneda'; 

--10.Obtener los datos completos de los usuarios cuyos nombres contengan la letra ‘u’.
SELECT * FROM usuario WHERE nombre LIKE '%u%';

--11. Traer las ventas entre junio del 2020 y febrero 2021.
SELECT * FROM venta WHERE fecha_de_venta BETWEEN '2020-06-01' AND '2021-02-28';

--12. Obtener los usuarios registrados antes del 2021.
SELECT * FROM venta WHERE fecha_de_venta<'2021-01-01';

--13.Agregar el producto llamado ‘Chocolate’, de tipo Sólido y con un precio de 25,35.
INSERT INTO `producto`(`codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`) VALUES (12345678,'Chocolate','solido',0,25.35);

--14.Insertar un nuevo usuario .
INSERT INTO `usuario`(`nombre`, `apellido`, `clave`, `mail`, `localidad`) VALUES ('Lautaro','Lemos',123456,'llemos@example.com','Avellaneda');

--15.Cambiar los precios de los productos de tipo sólido a 66,60.
UPDATE `producto` SET `precio`=66.60 WHERE producto.tipo='solido';

--16.Cambiar el stock a 0 de todos los productos cuyas cantidades de stock sean menores a 20 inclusive.
UPDATE `producto` SET `stock`=0 WHERE stock<=20;

--17.Eliminar el producto número 1010.
DELETE FROM `producto` WHERE id=1010;

--18.Eliminar a todos los usuarios que no han vendido productos.
DELETE FROM usuario WHERE usuario.id NOT IN (SELECT venta.id_usuario FROM venta);

