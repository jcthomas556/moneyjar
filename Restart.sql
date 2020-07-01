drop table users_jars; 
drop table jars;

CREATE TABLE jars(
    jar_id serial PRIMARY KEY,
    jar_owner_id int NOT NULL,
    jar_total double precision NOT NULL,
    jar_active BOOLEAN NOT NULL,
    jar_name TEXT NOT NULL,
    jar_invite_code int UNIQUE NOT NULL
);
CREATE TABLE users_jars(
    entry_id serial PRIMARY KEY,
    user_id int references accounts(user_id) NOT NULL,
    jar_id int references jars(jar_id) NOT NULL
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
    34.43,
    true,
    'Jacobs 2nd jar',
    (SELECT ROUND ( (SELECT random() * (SELECT random() * 2345247 +1) )))
);
INSERT INTO users_jars(
    user_id,
    jar_id
)
VALUES(
    (SELECT user_id FROM accounts WHERE passwords = crypt('skeleton0', passwords) AND email = crypt('admin@admin.com', email) ),
    (SELECT jar_id FROM jars WHERE jar_owner_id = 
            (SELECT user_id FROM accounts WHERE passwords = crypt('skeleton0', passwords) AND email = crypt('admin@admin.com', email) 
        AND jar_name = 'Jacobs 2nd jar')
    )
);

select * from jars;
select * from users_jars;
