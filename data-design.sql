CREATE TABLE topic (
    topicId BINARY(16) NOT NULL,
    topicName VARCHAR(16) NOT NULL,
);
CREATE TABLE article (
    articleId BINARY(16) NOT NULL,
    articlTopicId BINARY(16) NOT NULL,
    articleAuthor VARCHAR(16) NOT NULL,
    articleDate DATE(6) NOT NULL,
    articleName VARCHAR(16) NOT NULL,
);
CREATE TABLE reference (
    referenceId BINARY(16) NOT NULL,
    referenceArticleId BINARY(16) NOT NULL,
    referenceAuthor VARCHAR(16) NOT NULL,
    referenceDatePublished DATE(6),
    referenceDoi VARCHAR (16),
);