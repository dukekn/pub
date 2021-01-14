# Pub CRUD
 
DB:
```
CREATE TABLE car (
    id           INTEGER       PRIMARY KEY
                               UNIQUE,
    is_visible   BOOLEAN       DEFAULT (1),
    is_hybrid    BOOLEAN,
    is_4x4       BOOLEAN,
    is_automatic BOOLEAN,
    manufacturer VARCHAR (256),
    model        VARCHAR (256),
    year         VARCHAR (4),
    engine       VARCHAR (256),
    fuel         VARCHAR (64),
    email        VARCHAR,
    password     VARCHAR
);
```

