CREATE TABLE con (
id INT AUTO_INCREMENT PRIMARY KEY,
user_name VARCHAR(100) NOT NULL, 
user_phone VARCHAR(20) NOT NULL,
user_message VARCHAR(1000) 
);



ALTER TABLE con ADD COLUMN `date` VARCHAR(20) AFTER id;
DELIMITER //

CREATE TRIGGER set_date_on_insert
BEFORE INSERT ON con
FOR EACH ROW
BEGIN
    SET NEW.`date` = DATE_FORMAT(CURDATE(), '%e %b %Y');
END //

DELIMITER ;


-- ////////////////////////////////////

-- Create the table
CREATE TABLE con (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date VARCHAR(20),
    user_name VARCHAR(100) NOT NULL,
    user_phone VARCHAR(20) NOT NULL,
    user_message VARCHAR(1000)
);

-- Create the trigger
DELIMITER //

CREATE TRIGGER set_date_on_insert
BEFORE INSERT ON con
FOR EACH ROW
BEGIN
    SET NEW.`date` = DATE_FORMAT(CURDATE(), '%e %b %Y');
END //

DELIMITER ;


-- insert 


INSERT INTO con (user_name, user_phone, user_message)
VALUES
  ('Смирнов Игорь', '+7 701 1234 567', 'Требуется юридическая помощь в разрешении спора.'),
  ('Попова Екатерина', '+7 702 2345 678', 'Ищу адвоката для консультации по гражданским делам.'),
  ('Иванова Анна', '+7 705 3456 789', 'Нужна помощь в составлении договора.'),
  ('Сидорова Елена', '+7 707 4567 890', 'Ищу юриста для представления интересов в суде.'),
  ('Кузнецов Дмитрий', '+7 708 5678 901', 'Требуется консультация по налоговым вопросам.'),
  ('Васильев Максим', '+7 747 6789 012', 'Ищу адвоката для разрешения трудового конфликта.'),
  ('Морозова Ольга', '+7 777 7890 123', 'Нужна помощь в получении разрешения на строительство.'),
  ('Новиков Михаил', '+7 778 8901 234', 'Ищу юриста для защиты авторских прав.'),
  ('Алексеева Анна', '+7 701 9012 345', 'Требуется консультация по семейному праву.'),
  ('Козлов Сергей', '+7 702 0123 456', 'Ищу адвоката для разрешения вопросов по наследству.');




-- redjust after deleting

SET @count = 0;
UPDATE con SET id = @count:= @count + 1;
ALTER TABLE con AUTO_INCREMENT = 1;
