INSERT INTO topic (topicId, topicName)
VALUES (UNHEX(REPLACE("7b96dbd5-580c-49c3-898f-e252d8f2a251", "-", "")),'ADD & ADHD');

INSERT INTO topic (topicId, topicName)
VALUES (UNHEX(REPLACE("31755cd7-2ca5-441d-b673-17eceb59351a", "-", "")),'Addiction');

INSERT INTO topic (topicId, topicName)
VALUES (UNHEX(REPLACE("270b6286-e151-40ca-9e2f-de1650cd4808", "-", "")),'Alzheimers');

INSERT INTO topic (topicId, topicName)
VALUES (UNHEX(REPLACE("e7f3319d-e024-47a8-b4cc-f08d4bac65c6", "-", "")),'Autism');



UPDATE topic set topicName = 'Depression' WHERE topicName = 'Alzheimers';
UPDATE topic set topicName = 'Headaches' WHERE topicName ='Autism';

DELETE FROM topic WHERE topicName= 'Headaches';
DELETE FROM topic WHERE topicName= 'Depression';