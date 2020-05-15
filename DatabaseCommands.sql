drop table accounts;

CREATE TABLE accounts(
	user_id serial PRIMARY KEY,
	password TEXT NOT NULL,
	email TEXT UNIQUE NOT NULL,
	created_on TIMESTAMP NOT NULL	
);



INSERT into accounts (
    password,
    email,
    created_on
)
VALUES(
    crypt('skeleton0', gen_salt('bf')),
    crypt('admin@admin.com', gen_salt('bf')),
    CURRENT_DATE
);


SELECT user_id
FROM accounts
WHERE password = crypt('skeleton0', password)
AND email = crypt('admin@admin.com', email);