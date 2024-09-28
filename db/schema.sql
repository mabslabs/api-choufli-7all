/** ensure when create the database to use utf8mb4_unicode_ci
CREATE DATABASE choufli_7all_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
**/

CREATE TABLE actors
(
    actors_id   SERIAL UNIQUE NOT NULL PRIMARY KEY,
    actors_slug VARCHAR(100)  NOT NULL,
    actors_name VARCHAR(100)  NOT NULL
) CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

CREATE TABLE quotes
(
    quotes_id             SERIAL UNIQUE NOT NULL PRIMARY KEY,
    quotes_text           VARCHAR(1000) NOT NULL,
    id_author             INT           NOT NULL REFERENCES actors (authors_id) ON UPDATE CASCADE,
    quotes_counter_random INT           NOT NULL DEFAULT 0
) CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

INSERT INTO actors (actors_slug, actors_name) VALUES ('sboui', 'السبوعي');
INSERT INTO actors (actors_slug, actors_name) VALUES ('slimene', 'سليمان الأبيض');
INSERT INTO actors (actors_slug, actors_name) VALUES ('zeineb', 'زينب');
INSERT INTO actors (actors_slug, actors_name) VALUES ('fadhila', 'لالة فضيلة');
INSERT INTO actors (actors_slug, actors_name) VALUES ('azza', 'عزّة');
INSERT INTO actors (actors_slug, actors_name) VALUES ('dalanda', 'دالندا');
INSERT INTO actors (actors_slug, actors_name) VALUES ('jannet', 'جنّاة');
INSERT INTO actors (actors_slug, actors_name) VALUES ('fouchika', 'فوشيكا');
INSERT INTO actors (actors_slug, actors_name) VALUES ('beji', 'الباجي ماتريكس');
