drop table accounts;

CREATE TABLE accounts(
	user_id serial PRIMARY KEY,
	passwords TEXT NOT NULL,
	email TEXT UNIQUE NOT NULL,
    user_name text NOT NULL,
	created_on TIMESTAMP NOT NULL	
);

CREATE TABLE jars(
    jar_id serial PRIMARY KEY,
    user_id int references accounts(user_id),
    jar_owner TEXT NOT NULL,
    jar_total MONEY NOT NULL,
    jar_active BOOLEAN NOT NULL
);

INSERT into jars(
    user_id,
    jar_owner,
    jar_total,
    jar_active
)
VALUES(
    (SELECT user_id FROM accounts WHERE passwords = crypt('skeleton0', passwords) AND email = crypt('admin@admin.com', email) ),
    (SELECT user_name FROM accounts WHERE passwords = crypt('skeleton0', passwords) AND email = crypt('admin@admin.com', email) ),
    '34.43',
    true
);

INSERT into accounts (
    passwords,
    email,
    user_name,
    created_on
)
VALUES(
    crypt('skeleton0', gen_salt('bf')),
    crypt('admin@admin.com', gen_salt('bf')),
    'Jacob',
    CURRENT_DATE
);

INSERT into accounts (
    passwords,
    email,
    user_name,
    created_on
)
VALUES(
    'bobby',
    'emailie',
    'Bob',
    CURRENT_DATE
);


INSERT INTO accounts (passwords, email, user_name, created_on)
            VALUES(
                crypt('Dan', gen_salt('bf')),
                crypt('Dan@gmail.com', gen_salt('bf')), 
                'Dan',
                CURRENT_DATE)


SELECT user_id, user_name
FROM accounts
WHERE passwords = crypt('skeleton0', passwords)
AND email = crypt('admin@admin.com', email);


SELECT user_id
FROM accounts
WHERE email = crypt('ken@gmail.com', email);
