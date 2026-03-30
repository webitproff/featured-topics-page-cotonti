# Featured and Recommended Forum Topics in Article
**Allows attaching recommended forum topics to articles and displaying them on the article page.**

![featured-topics-page-cotonti_0](https://raw.githubusercontent.com/webitproff/featured-topics-page-cotonti/refs/heads/main/featuredtopicspage/img/image.webp)

## Featured Topics from Forums in Article

### Overview and User Guide for the Cotonti Plugin

---

### 1. Purpose of the Plugin and the Problem It Solves

The **Featured Topics from Forums in Item of Article** plugin is designed to create a solid, managed link between content items of the *Page* module (articles) and forum topics of the *Forums* module in Cotonti CMS.

Its key task is to **allow an editor or administrator to manually attach selected forum topics to a specific article and display them on the article page as a separate information block**.

The plugin does not handle automatic selection, recommendation algorithms, relevance, or analytics.  
It implements **conscious editorial linking**: article → selected forum topics.

> This is an editorial tool, not a recommendation engine.

---

### 2. Architectural Model and Operating Principle

#### 2.1. Data Relationship Type

The plugin implements a **one-to-many relationship**:

- **One article**
- **Several attached forum topics**

The link is stored in a separate database table and does not interfere with the structure of Cotonti's standard tables.

Each link contains:

- article ID,
- forum topic ID,
- display order of the topic in the list.

Duplicate links between the same article and topic are **impossible at the database level**.

---

#### 2.2. Data Isolation and Security

- When an article is deleted, all associated records are automatically removed.
- When an article is updated, the list of links is completely rebuilt.
- The plugin does not modify the data of forum topics or articles.
- Validation is performed at the level of:
  - topic existence,
  - topic state (only active topics),
  - user permissions.

---

### 3. Requirements and Compatibility

The plugin **strictly depends** on the standard Cotonti modules:

- Page
- Forums

Additionally:

- Works with the **Attacher** plugin if it is active.
- Uses the **Select2** interface through Cotonti system resources.
- Compatible with Cotonti **0.9.26** and PHP **8.4+**.

Without the Page or Forums modules, the plugin will not work.

---

### 4. User Roles and Access Control

#### 4.1. Administrator

The administrator has full control:

- can attach **any forum topics** to any article;
- sees all topics in the AJAX search;
- is not restricted by topic authorship.

#### 4.2. Regular User (Article Author)

Strict restrictions apply to regular users:

- the search displays **only topics created by that user**;
- cannot attach another user's topic;
- cannot bypass the restriction by manually manipulating data.

Thus, the plugin respects Cotonti's authorship model.

---

### 5. Article Edit Interface

#### 5.1. Embedding into the Edit Form

The plugin adds a separate logical block to the article edit form:

- the block title is set by the language file;
- the block is displayed only if the user has write permissions;
- the number of rows strictly matches the plugin configuration.

Each row represents **one potential recommended forum topic**.

---

#### 5.2. Selecting Forum Topics

Selection uses **AJAX search**:

- search starts after entering at least two characters;
- uses an asynchronous request;
- results are sorted by topic update date;
- the number of results is limited by settings.

Selection is made through a visual selector without direct ID input.

> The interface does not allow manual value substitution without interfering with the HTML.

---

#### 5.3. Limiting the Number of Topics

The maximum number of attachable topics:

- is set in the plugin configuration;
- is strictly enforced during saving;
- exceeding it is physically impossible.

The order of topics is determined by **the order of rows in the edit form**.

---

### 6. Data Saving and Processing

#### 6.1. Saving Mechanism

When saving an article:

1. All existing links are deleted.
2. Received data is validated.
3. Checks are performed for:
   - topic existence;
   - its active state;
   - absence of duplicates.
4. Data is saved with sequential order.

#### 6.2. Error Protection

The plugin automatically ignores:

- empty values,
- duplicates,
- non-existent topics,
- topics in inactive state.

---

### 7. Display on the Article Page

#### 7.1. Display Conditions

The recommended topics block is displayed **only if**:

- the plugin is active;
- the article has attached topics;
- the topics are active.

If conditions are not met, **the template is not loaded at all**, avoiding unnecessary load.

---

#### 7.2. Information Displayed per Topic

For each topic, the following are displayed:

- topic title;
- brief description or preview;
- forum category;
- number of messages;
- number of views;
- name of the last author;
- last update date;
- image (if available).

All data is taken directly from the forum topics table.

---

#### 7.3. Image Handling

The image logic is strictly defined:

- uses the **first image from the first post of the topic**;
- if Attacher is active, the attached file is taken;
- if no image exists, a placeholder from the settings is used;
- the placeholder path is set by the administrator.

The plugin does not generate images or modify files.

---

### 8. Text and Description Processing

The topic description is formed according to the following priority:

1. Topic description field.
2. Preview of the first post.

The text:

- is stripped of HTML;
- is converted to plain text;
- is truncated strictly according to the character limit from the settings.

No automatic generation or addition of text is performed.

---

### 9. Multilingual Support

The plugin **does not implement its own multilingualism**, but:

- correctly uses the Cotonti forum structure;
- displays the category name in the current site language;
- if no translation is available, shows the category code.

Thus, it is **fully compatible** with the multilingual forum structure.

---

### 10. Practical Use Scenarios

#### 10.1. Articles + Discussions

Classic scenario:

- article as the main material;
- attached topics – discussion, questions, additions.

#### 10.2. Documentation and Support

- article – instruction or manual;
- forum topics – user questions, bug reports.

#### 10.3. Educational Projects

- article – lesson or lecture;
- topics – discussion of assignments and solutions.

#### 10.4. Commercial and Content Projects

- article – product review;
- topics – reviews, questions, usage experience.

---

### 11. Limitations and Scope of Responsibility

The plugin **does not**:

- automatically select topics;
- analyze relevance;
- sort by popularity;
- perform SEO optimization;
- cache data.

It does **exactly what is explicitly built into its logic**:

> Links articles with selected forum topics and displays them.

---

### 12. Final Assessment

Featured Topics from Forums in Article is:

- a clear editorial tool;
- transparent logic without hidden mechanisms;
- strict access control;
- proper integration with Cotonti.

The plugin is ideal for projects where the forum and articles are **a unified content system**, not separate modules.

> This is not a "smart" plugin.  
> It is a **controlled, predictable, and professional tool**.

---

### Template Code Snippets

`page.edit.tpl`

```
<!-- IF {PHP|cot_plugin_active('featuredtopicspage')} -->
	<!-- IF {PHP|cot_auth('plug', 'featuredtopicspage', 'W')} -->
		{FEATURED_FR_TOPIC_PAGE_EDIT_TOPIC} 
	<!-- ENDIF -->
<!-- ENDIF -->
<hr>
```

`page.tpl`

```
<!-- IF {PHP|cot_plugin_active('featuredtopicspage')} AND {FEATURED_FR_TOPIC_PAGE_TOPICS_TRUE} -->
{FEATURED_FR_TOPIC_PAGE_TOPICS}
<!-- ENDIF -->
```

source https://github.com/webitproff/featured-topics-page-cotonti/
web https://abuyfile.com/en/market/cotonti/featured-topics-page
