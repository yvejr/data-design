<!DOCTYPE html>
<html lang="en"
<head>
    <meta charset="UTF-8"/>
    <title>Data Design for Science Daily References</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <h1>Data Design for <a href="https://www.sciencedaily.com/"target="_blank">Science Daily</a> References</h1>
    <h2>Persona</h2>
        <ul>
            <li>Name: Lilly</li>
            <li>Age: 25</li>
            <li>Occupation: Undergraduate student of psychology</li>
            <li>Technology: Fluent user with a MacBook Pro 15" OS High Sierra 10.13.4 and an Apple iPhone X iOS 11.3</li>
            <li>Attitude: She is used to research and sometimes having to go several sources in to find what she wants, but hates getting lost in databases or the Google rabbit hole.</li>
            <li>Goal: To be able to find relevant articles and cite the sources to do additional research.</li>
            <li>Frustrations: Hates getting lost in databases trying to find original source material, or searching through Google results. Especially dislikes when article are cited incorrectly.  Inability to export or copy citations in APA format.</li>
        </ul>
    <h2>User Story</h2>
        <p> As a student, Lilly wants to use <a href="https://www.sciencedaily.com/"target="_blank">Science Daily</a> to find short news articles on current research.</p>
    <h2>Use Case</h2>
        <p>Lilly checks Science Daily to see current science news in psychology.
        </p>
    <h2>Interaction Flow</h2>
         <ul>
            <li>User navigates to <a href="https://www.sciencedaily.com/"target="_blank">Science Daily</a> </li>
            <li>User mouses over "Health" in nav bar and clicks on "Mind and Brain"</li>
            <li>Site directs to page with recent headlines </li>
            <li>User clicks on an a news article</li>
            <li>Site loads the selected article</li>
            <li>User reads the article then clicks on the journal reference at the end of the page</li>
            <li>Site opens new tab to appropriate link</li>
        </ul>
    <h1>Conceptual model</h1>
    <h2>Conditions</h2>
        <ul>
            <li>Precondition: An article has already been published on the site with the appropriate references.</li>
            <li>Post-condition: The article displays references for readers.</li>
            <li>Frequency of use: Daily</li>
        </ul>
    <h2>Entities and Attributes</h2>
    <h3>Category</h3>
        <ul>
            <li>categoryName</li>
            <li>categoryId (primary key)</li>
        </ul>
    <h3>SubCategory</h3>
        <ul>
            <li>subCategoryName</li>
            <li>subCategoryId (primary key)</li>
        </ul>
    <h3>Topic</h3>
        <ul>
            <li>topicName</li>
            <li>topicId (primary key)</li>
        </ul>
    <h3>Article</h3>
        <ul>
            <li>articleName</li>
            <li>articleId (primary key)</li>
            <li>articleDate</li>
            <li>articleAuthor</li>
            <li>articleSummaryId(foreign key)</li>
            <li>articleViewCount</li>
            <li>articleCategoryId (foreign key)</li>
            <li>articleSubCategoryId (foreign key)</li>
            <li>articleTopicId (foreign key)</li>
        </ul>
    <h3>Reference</h3>
        <ul>
            <li>referenceId (primary key)</li>
            <li>referenceDoi</li>
            <li>referenceAuthor</li>
            <li>referenceDatePublished</li>
            <li>referenceArticleId (foreign key)</li>
        </ul>
    <h2>Relationships</h2>
        <ul>
            <li>One category can have multiple subcategories.</li>
            <li>One subcategory can have one category.</li>
            <li>One topic can be multiple subcategories.</li>
            <li>One subcategory can have multiple topics.</li>
            <li>One topic can have multiple articles.</li>
            <li>One article can appear in multiple topics.</li>
            <li>One article can have multiple topics.</li>
            <li>One article can have one reference.</li>
            <li>One reference can have multiple articles.</li>
        </ul>
    <h1>Logical Model</h1>
    <img src="erdfordatadesign.svg" alt="diagram of logical model">
</body>
</html>
