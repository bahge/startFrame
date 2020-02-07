CREATE table users (
    id int(11) AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150),
    email VARCHAR(150),
    pass VARCHAR(40),
    nivel int(11),
    status int(11)
);

INSERT INTO users 
    (nome, email, pass, nivel, status) 
    VALUES 
    (
        'Admin', 
        'admin@123', 
        'adcd7048512e64b48da55b027577886ee5a36350', 
        '0', 
        '1'
    );