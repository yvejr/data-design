CREATE TABLE topic (
    topicId,
    topicName,
);
CREATE TABLE article (
    articleId,
    articlTopicId,
    articleAuthor,
    articleDate,
    articleName,
);
CREATE TABLE reference (
    referenceId,
    referenceArticleId,
    referenceAuthor,
    referenceDatePublished,
    referenceDoi,
);