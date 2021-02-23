PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "users" ("id" integer not null primary key autoincrement, "name" varchar not null, "email" varchar not null, "address" varchar not null, "email_verified_at" datetime null, "password" varchar not null, "remember_token" varchar null, "created_at" datetime null, "updated_at" datetime null, "birthday" date null, "phone" varchar null, "cpf" varchar null, "avatar" varchar null);

CREATE TABLE IF NOT EXISTS "carteira" ("id" integer not null primary key autoincrement, "categoria" varchar not null, "produto" varchar not null, "nome" varchar not null, "corretora" varchar not null, "data_negociacao" date not null, "quantidade" numeric not null, "valor" numeric not null, "compra_venda" varchar not null, "created_at" datetime null, "updated_at" datetime null);

CREATE TABLE IF NOT EXISTS "proventos" ("id" integer not null primary key autoincrement, "nome" varchar not null, "valor" varchar not null, "data_negociacao" date not null, "created_at" datetime null, "updated_at" datetime null);

CREATE TABLE IF NOT EXISTS "metas" ("id" integer not null primary key autoincrement, "descricao" varchar not null, "valor" varchar not null, "created_at" datetime null, "updated_at" datetime null);

CREATE UNIQUE INDEX "users_email_unique" on "users" ("email");
COMMIT;
