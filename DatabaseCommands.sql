drop table account;

CREATE TABLE account(
	user_id serial PRIMARY KEY,
	password VARCHAR (50) NOT NULL,
	email VARCHAR (355) UNIQUE NOT NULL,
	created_on TIMESTAMP NOT NULL	
);

INSERT into account (
    user_id,
    password,
    email,
    created_on
)
VALUES(
    1,
    'skeleton0',
    'admin@admin.com',
    CURRENT_DATE
);