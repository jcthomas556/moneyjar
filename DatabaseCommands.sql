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
    jar_owner_id int NOT NULL,
    jar_total MONEY NOT NULL,
    jar_active BOOLEAN NOT NULL,
    jar_name TEXT NOT NULL,
    jar_invite_code int UNIQUE NOT NULL
);


CREATE TABLE users_jars(
    entry_id serial PRIMARY KEY,
    user_id int references accounts(user_id) NOT NULL,
    jar_id int references jars(jar_id) NOT NULL
);

INSERT INTO users_jars(
    user_id,
    jar_id
)
VALUES(
    (SELECT user_id FROM accounts WHERE passwords = crypt('skeleton0', passwords) AND email = crypt('admin@admin.com', email) ),
    (SELECT jar_id FROM jars WHERE jar_owner_id = 
            (SELECT user_id FROM accounts WHERE passwords = crypt('skeleton0', passwords) AND email = crypt('admin@admin.com', email) 
        AND jar_name = 'Jacobs jar')
    )
);
            
INSERT INTO users_jars(
    user_id,
    jar_id
)
VALUES(
    (SELECT user_id FROM accounts WHERE passwords = crypt('skeleton0', passwords) AND email = crypt('admin@admin.com', email) ),
    (SELECT jar_id FROM jars WHERE jar_owner_id = 
            (SELECT user_id FROM accounts WHERE passwords = crypt('skeleton0', passwords) AND email = crypt('admin@admin.com', email) 
        AND jar_name = 'Jacobs better jar')
    )
);

INSERT INTO users_jars(
    user_id,
    jar_id
)
VALUES(
    (SELECT user_id FROM accounts WHERE passwords = crypt('somethingrandom', passwords) AND email = crypt('klthomas931@gmail.com', email) ),
    1
    
);



INSERT into jars(
    jar_owner_id,
    jar_total,
    jar_active,
    jar_name,
    jar_invite_code
)
VALUES(
    (SELECT user_id FROM accounts WHERE passwords = crypt('skeleton0', passwords) AND email = crypt('admin@admin.com', email) ),
    '34.43',
    true,
    'Jacobs jar',
    (SELECT ROUND ( (SELECT random() * (SELECT random() * 2345247 +1) )))
);

-- insert into users_jars(
--     user_id,
--     jar_id
-- )
-- VALUES(
--     $userID,
--     (SELECT jar_id )
-- )


INSERT into jars(
    jar_owner_id,
    jar_total,
    jar_active,
    jar_name
)
VALUES(
    (SELECT user_id FROM accounts WHERE passwords = crypt('skeleton0', passwords) AND email = crypt('admin@admin.com', email) ),
    '24.41',
    true,
    'Jacobs better jar'
);




SELECT jar_total, jar_active, user_id, jar_name FROM jars WHERE user_id = '1';

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



SELECT UJ.user_id, J.jar_id, J.jar_total, J.jar_name, J.jar_active FROM users_jars AS UJ LEFT JOIN jars AS J ON (UJ.jar_id = J.jar_id) ;

select * from users_Jars;

INSERT into jars (jar_owner_id, jar_total, jar_active, jar_name)
VALUES (
        1,
        0,
        true,
        'name'
);
INSERT INTO users_jars(user_id, jar_id)
VALUES(
    1,
    (SELECT jar_id FROM jars WHERE jar_owner_id = 1 AND jar_name = 'name')
)


INSERT into jars (jar_owner_id, jar_total, jar_active, jar_name)
                    VALUES (
                            1,
                            0,
                            true,
                            'jareo'
                    )

                    INSERT INTO users_jars (user_id, jar_id)
                    VALUES(
                        '1',
                        (SELECT jar_id FROM jars WHERE jar_owner_id = '1' AND jar_name = 'name')
                    )