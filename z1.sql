CREATE TABLE `users` (
    `id`         INT(11) NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(255) NOT NULL,
    `gender`     TINYINT(1) NOT NULL COMMENT '0 - не указан, 1 - мужчина, 2 - женщина.',
    `birth_date` INT(11) NOT NULL COMMENT 'Дата в unixtime.',
    PRIMARY KEY (`id`)
);

CREATE TABLE `phone_numbers` (
    `id`      INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `phone`   CHAR(15) NOT NULL,
    PRIMARY KEY (`id`)
);

-- Добавление индексов
ALTER TABLE users ADD INDEX `gender` (`gender`);
ALTER TABLE phone_numbers ADD INDEX `user_id` (`user_id`);

-- Сам запрос
SELECT
    u.`name`,
    COUNT(pn.`id`)
FROM
    `users` u
JOIN `phone_numbers` pn ON
    pn.`user_id` = u.`id`
WHERE
    u.`gender` = 2 AND(
        (YEAR(CURRENT_TIME) - YEAR(FROM_UNIXTIME(u.`birth_date`))) - (
            (
                DATE_FORMAT(CURRENT_TIME, '00-%m-%d') < DATE_FORMAT(
                    FROM_UNIXTIME(u.`birth_date`),
                    '00-%m-%d'
                )
            )
        )
    ) BETWEEN 18 AND 22
GROUP BY
    u.`id`