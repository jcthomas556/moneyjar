drop table accounts;

CREATE TABLE accounts(
	user_id serial PRIMARY KEY,
	passwords TEXT NOT NULL,
	email TEXT UNIQUE NOT NULL,
    user_name text NOT NULL,
	created_on TIMESTAMP NOT NULL	
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


-- SELECT user_id, user_name
-- FROM accounts
-- WHERE passwords = crypt('skeleton0', passwords)
-- AND email = crypt('admin@admin.com', email);

-- SELECT user_id
-- FROM accounts
-- WHERE email = crypt('admin@admin.com', email);
