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