create schema ejemplolaravel
use ejemplolaravel
select * from task
select * from user




DELIMITER //

CREATE PROCEDURE getAllUsers()
BEGIN
    SELECT * FROM User WHERE is_active = 1;
END //

DELIMITER ;

DELIMITER //
CREATE PROCEDURE getAllActiveUsers()
BEGIN
    SELECT * FROM user WHERE is_active = 1;
END //
DELIMITER ;

DROP PROCEDURE getAllActiveUsers

CALL getAllUsers();
CALL getAllActiveUsers()




