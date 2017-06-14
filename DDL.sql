CREATE EXTENSION postgis;

CREATE TABLE bairro (
	id SERIAL PRIMARY KEY,
	nome TEXT NOT NULL
);
	
CREATE TABLE ocorrencia_tipo (
	id SERIAL PRIMARY KEY,
	descricao TEXT UNIQUE NOT NULL
);

CREATE TABLE ocorrencia (
	id SERIAL PRIMARY KEY,
	bairro_id INTEGER REFERENCES bairro(id) NOT NULL,
	tipo_id INTEGER REFERENCES ocorrencia_tipo(id) NOT NULL,
	descricao TEXT NOT NULL
);

SELECT AddGeometryColumn('public', 'bairro', 'coordenadas', 4326, 'POLYGON', 2);
SELECT AddGeometryColumn('public', 'ocorrencia', 'localizacao', 4326, 'POINT', 2);