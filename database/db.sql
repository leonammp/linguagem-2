PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "users" (
    "id" integer not null primary key autoincrement,
    "name" varchar not null,
    "email" varchar not null,
    "address" varchar not null,
    "password" varchar not null,
    "birthday" date null,
    "phone" varchar null,
    "cpf" varchar null,
    "avatar" varchar null,
    "created_at" datetime null,
    "updated_at" datetime null);
CREATE UNIQUE INDEX "users_email_unique" on "users" ("email");
COMMIT;
