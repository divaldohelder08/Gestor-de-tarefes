create database IF NOT EXISTS SoftCode ;

use SoftCode;

create table
    user(
        id int primary key auto_increment,
        nome varchar(250) not null,
        email varchar(250) not null unique
    );

create table
    tarefa (
        id int primary key auto_increment,
        descricao varchar(50) not null,
        nivel enum ("baixo", "médio", "alto"),
        data DATETIME default CURRENT_TIMESTAMP(),
        estado enum (
            "não atribuída",
            "em espera",
            "não finalizada",
            "finalizada"
        ) not null,
        user_id int,
        foreign key(user_id) references user(id) on delete cascade
    );

