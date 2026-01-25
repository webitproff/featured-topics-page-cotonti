<!-- BEGIN: MAIN -->
<div class="py-3">
<div class="alert alert-success"><h3 class="fs-6 my-0">{PHP.L.featuredtopicspage_page_title}</h3></div>
	<div class="list-group list-group-striped list-group-flush">
		<!-- BEGIN: FEATURED_FR_TOPIC_PAGE_ROW -->
		<div class="list-group-item list-group-item-action px-0">
			<div class="d-flex flex-column flex-md-row gap-3 align-items-center">
				<!-- IF {FEATURED_FR_TOPIC_PAGE_ROW_LINK_MAIN_IMAGE} -->
				<a href="{FEATURED_FR_TOPIC_PAGE_ROW_URL}" class="">
					<img
					src="{FEATURED_FR_TOPIC_PAGE_ROW_LINK_MAIN_IMAGE}"
					alt="{FEATURED_FR_TOPIC_PAGE_ROW_TITLE}"
					class="img-fluid rounded d-block mx-auto"
					style="object-fit:cover;
					width:100px;
					max-height:120px;
					height:auto;"
					>
				</a>
				<!-- ENDIF -->
				<div class="flex-grow-1 d-flex flex-column justify-content-center">
					<a href="{FEATURED_FR_TOPIC_PAGE_ROW_URL}" class="text-decoration-none">
						<p class="mb-1 fw-semibold">
							{FEATURED_FR_TOPIC_PAGE_ROW_TITLE}
						</p>
					</a>
					<div class="mb-1">
						<div>
						<small class="text-secondary">
							<!-- IF {FEATURED_FR_TOPIC_PAGE_ROW_DESC} -->
							{FEATURED_FR_TOPIC_PAGE_ROW_DESC}
							<!-- ELSE -->
							{FEATURED_FR_TOPIC_PAGE_ROW_PREVIEW}
							<!-- ENDIF -->
						</small>
						</div>
						<small class="text-secondary">#{FEATURED_FR_TOPIC_PAGE_ROW_ID} | Постов: {FEATURED_FR_TOPIC_PAGE_ROW_POSTCOUNT} | Просмотров: {FEATURED_FR_TOPIC_PAGE_ROW_VIEWCOUNT}</small>
					</div>
					<div>
						<small>
							<a href="{FEATURED_FR_TOPIC_PAGE_ROW_CAT_URL}">
								{FEATURED_FR_TOPIC_PAGE_ROW_CAT_TITLE}
							</a>
						</small>
					</div>
				</div>
			</div>
		</div>
		<!-- END: FEATURED_FR_TOPIC_PAGE_ROW -->
	</div>
</div>
<!-- END: MAIN -->
/**
 * featuredtopicspage.page.topics.tpl - Template File for the Plugin Featured and Recommended Forum Topics in Article Item
 *
 * featuredtopicspage plugin for Cotonti 0.9.26, PHP 8.4+ 
 * Filename: featuredtopicspage.page.topics.tpl
 *
 * Date: Jan 23Th, 2026 
 * @package featuredtopicspage 
 * @version 2.7.8 
 * @author webitproff 
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff 
 * @license BSD 
 */

