DELIMITER $$
CREATE OR REPLACE PROCEDURE Ex3a()
BEGIN
	SELECT clasa, sursa, destinatia
	FROM bilete
	WHERE valoare > 1000
	ORDER BY valoare ASC, sursa DESC;
END $$
DELIMITER;

DELIMITER $$
CREATE OR REPLACE PROCEDURE Ex3b()
BEGIN
	SELECT aparat_zbor, nr_locuri
	FROM zboruri
	WHERE nr_locuri < 300 
	ORDER BY nr_locuri ASC;
END $$
DELIMITER ;