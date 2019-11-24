/*
    BASE DE DATOS: ORACLE DATABASE 12c
    VERSION DE ORACLE: 12.2.0.1.0    
*/



--Realizar estos pasos en usuarios root de oracle database
    create user C##Biblioteca identified by "01001100"; --otorgar todos los permisos.
    create or replace directory DIR_IMAGENES as 'C:\Firmas';
    grant read, write on directory FIRMAS to C##Biblioteca;

--Realizar la base de datos en la cuenta de C##Biblioteca
    create table libros(
        codigo_de_libro nvarchar2(20) not null,
        titulo nvarchar2(100) not null,
        editorial nvarchar2(100) not null,
        ejemplar number not null,
        eliminado number default 0,
        constraint PK_Codigo_de_libro primary key(codigo_de_libro)
    );

    create table alumnos(
        codigo_de_alumno nvarchar2(20) not null,
        apellido_paterno nvarchar2(25) not null,
        apellido_materno nvarchar2(25),
        nombres nvarchar2(50) not null,
        carrera nvarchar2(4) not null constraint CH_Carrera check(carrera in('BTDS','BTDI','BGC')),
        eliminado number default 0,
        constraint PK_Codigo_de_alumno primary key(codigo_de_alumno)
    );

    create table prestamos_de_libros(
        numero_de_perstamo_de_libro number not null,
        titulo_del_libro nvarchar2(100) not null,
        ejemplar_del_libro number not null,
        codigo_del_alumno nvarchar2(20) not null,
        nombre_del_alumno nvarchar2(100) not null,
        fecha nvarchar2(10)not null,
        hora_de_entrada nvarchar2(10) not null,
        hora_de_salida nvarchar2(10),
        firma blob default EMPTY_BLOB(),
        status number default 0,
        eliminado number default 0,
        constraint PK_Prestamo_de_libro primary key(numero_de_perstamo_de_libro)
    );

    create table prestamos_de_computadoras(
        numero_de_perstamo_de_computadora number not null,
        numero_de_computadora number not null,
        codigo_del_alumno nvarchar2(20) not null,
        nombre_del_alumno nvarchar2(100) not null,
        fecha nvarchar2(10)not null,
        hora_de_entrada nvarchar2(10) not null,
        hora_de_salida nvarchar2(10),
        firma blob default EMPTY_BLOB(),
        status number default 0,
        eliminado number default 0,
        constraint PK_Prestamo_de_computadora primary key(numero_de_perstamo_de_computadora)
    );

--Query de insersión de imagenes
    declare
        v_blob blob;
        v_bfile bfile;
    begin
        insert into imagenes(id, imagen) 
        values(1,EMPTY_BLOB()) returning imagen to v_blob;
        v_bfile := bfilename('FIRMAS','imagen.jpg');
        dbms_lob.open(v_bfile, dbms_lob.lob_readonly);
        dbms_lob.loadfromfile(v_blob, v_bfile, dbms_lob.getlength(v_bfile));
        dbms_lob.close(v_bfile);
    commit;
    end;

--Autoincrementador para los numeros de prestamos
    create sequence libros start with 1 increment by 1;


--Insertar datos en la tabla
insert into prestamos_de_libros(
    numero_de_prestamo_de_libro,
    titulo_del_libro,
    ejemplar_del_libro,
    codigo_del_alumno,
    nombre_del_alumno,
    fecha,
    hora_de_entrada
)
values(
    14,
    'CURSO DE FILOSOFIA 1',
    3,
    '219208909',
    'BARBA SANCHEZ SANDRA KARINA',
    to_char(sysdate,'DD/MM/YYYY'),
    to_char(sysdate,'HH:MI AM')
);


update prestamos_de_libros SET hora_de_salida = to_char(sysdate,'HH:MI AM') where numero_de_prestamo_de_libro = 5;
update prestamos_de_libros SET firma = BFILENAME('FIRMAS','firma.png') where numero_de_prestamo_de_libro = 5;
update prestamos_de_libros SET status = 1 where numero_de_prestamo_de_libro = 5;

update prestamos_de_computadoras SET hora_de_salida = to_char(sysdate,'HH:MI AM') where numero_de_prestamo_de_compu = 1;
update prestamos_de_computadoras SET firma = BFILENAME('FIRMAS','firma.png') where numero_de_prestamo_de_compu = 1;
update prestamos_de_computadoras SET status = 1 where numero_de_prestamo_de_compu = 1;