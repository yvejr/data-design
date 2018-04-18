ALTER DATABASE yjohnson6 CHARACTER SET utf8 COLLATE utf8_unicode_ci;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS reference;
DROP TABLE IF EXISTS topic;
CREATE TABLE topic (
    topicId BINARY(16) NOT NULL,
    topicName VARCHAR(16) NOT NULL,
    UNIQUE(topicId),
    PRIMARY KEY(topicId)
);
CREATE TABLE reference (
    referenceId BINARY(16) NOT NULL,
    referenceAuthor VARCHAR(16) NOT NULL,
    referenceDatePublished DATE NOT NULL,
    referenceDoi VARCHAR (16),
    UNIQUE (referenceId),
    PRIMARY KEY (referenceId)
);
CREATE TABLE article (
    articleId BINARY(16) NOT NULL,
    articleTopicId BINARY(16) NOT NULL,
    articleReferenceId BINARY(16) NOT NULL,
    articleAuthor VARCHAR(16) NOT NULL,
    articleContent BLOB NOT NULL,
    articleDate DATE NOT NULL,
    articleName VARCHAR(16) NOT NULL,
    INDEX(articleTopicId),
    INDEX(articleReferenceId),
    FOREIGN KEY(articleTopicId) REFERENCES topic(topicId),
    FOREIGN KEY(articleReferenceId) REFERENCES reference(referenceId),
    PRIMARY KEY(articleId)
);
