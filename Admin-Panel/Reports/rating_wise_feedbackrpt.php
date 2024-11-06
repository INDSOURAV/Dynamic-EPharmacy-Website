<?php
namespace PHPReportMaker12\project2;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "rautoload.php";
?>
<?php

// Create page object
if (!isset($rating_wise_feedback_rpt))
	$rating_wise_feedback_rpt = new rating_wise_feedback_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$rating_wise_feedback_rpt;

// Run the page
$Page->run();

// Setup login status
SetClientVar("login", LoginStatus());
if (!$DashboardReport)
	WriteHeader(FALSE);

// Global Page Rendering event (in rusrfn*.php)
Page_Rendering();

// Page Rendering event
$Page->Page_Render();
?>
<?php
echo "<br><center><b style='font-size:20px'>Rating Wise FeedBack Report</b></center><hr>";
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "rheader.php" ?>
<?php } ?>
<?php if ($Page->Export == "" || $Page->Export == "print") { ?>
<script>
currentPageID = ew.PAGE_ID = "rpt"; // Page ID
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Form object
var frating_wise_feedbackrpt = currentForm = new ew.Form("frating_wise_feedbackrpt");

// Validate method
frating_wise_feedbackrpt.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj), elm;

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
frating_wise_feedbackrpt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}
<?php if (CLIENT_VALIDATE) { ?>
frating_wise_feedbackrpt.validateRequired = true; // Uses JavaScript validation
<?php } else { ?>
frating_wise_feedbackrpt.validateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
frating_wise_feedbackrpt.lists["x_rating"] = <?php echo $rating_wise_feedback_rpt->rating->Lookup->toClientList() ?>;
frating_wise_feedbackrpt.lists["x_rating"].popupValues = <?php echo json_encode($rating_wise_feedback_rpt->rating->SelectionList) ?>;
frating_wise_feedbackrpt.lists["x_rating"].popupOptions = <?php echo JsonEncode($rating_wise_feedback_rpt->rating->popupOptions()) ?>;
frating_wise_feedbackrpt.lists["x_rating"].options = <?php echo JsonEncode($rating_wise_feedback_rpt->rating->lookupOptions()) ?>;
</script>
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<a id="top"></a>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-container" class="container-fluid ew-container">
<?php } ?>
<?php if (ReportParam("showfilter") === TRUE) { ?>
<?php $Page->showFilterList(TRUE) ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Page->DrillDownInPanel) {
	$Page->ExportOptions->render("body");
	$Page->SearchOptions->render("body");
	$Page->FilterOptions->render("body");
	$Page->GenerateOptions->render("body");
}
?>
</div>
<?php $Page->showPageHeader(); ?>
<?php $Page->showMessage(); ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
<!-- Center Container - Report -->
<div id="ew-center" class="<?php echo $rating_wise_feedback_rpt->CenterContentClass ?>">
<?php } ?>
<!-- Summary Report begins -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="report_summary">
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<!-- Search form (begin) -->
<?php
	echo "<strong>Date :- </strong>";
	date_default_timezone_set('Asia/Kolkata');
	echo date('d-m-Y H:i:s');
	echo "</br></br>";
?>
<?php

	// Render search row
	$Page->resetAttributes();
	$Page->RowType = ROWTYPE_SEARCH;
	$Page->renderRow();
?>
<form name="frating_wise_feedbackrpt" id="frating_wise_feedbackrpt" class="form-inline ew-form ew-ext-filter-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
<div id="frating_wise_feedbackrpt-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ew-row d-sm-flex">
<div id="c_rating" class="ew-cell form-group">
	<label for="x_rating" class="ew-search-caption ew-label"><?php echo $Page->rating->caption() ?></label>
	<span class="ew-search-field">
<?php $Page->rating->EditAttrs["onchange"] = "ew.forms(this).submit(); " . @$Page->rating->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="rating_wise_feedback" data-field="x_rating" data-value-separator="<?php echo $Page->rating->displayValueSeparatorAttribute() ?>" id="x_rating" name="x_rating"<?php echo $Page->rating->editAttributes() ?>>
		<?php echo $Page->rating->selectOptionListHtml("x_rating") ?>
	</select>
</div>
<?php echo $Page->rating->Lookup->getParamTag("p_x_rating") ?>
</span>
</div>
</div>
</div>
</form>
<script>
frating_wise_feedbackrpt.filterList = <?php echo $Page->getFilterList() ?>;
</script>
<!-- Search form (end) -->
<?php } ?>
<?php if ($Page->ShowCurrentFilter) { ?>
<?php $Page->showFilterList() ?>
<?php } ?>
<?php

// Set the last group to display if not export all
if ($Page->ExportAll && $Page->Export <> "") {
	$Page->StopGroup = $Page->TotalGroups;
} else {
	$Page->StopGroup = $Page->StartGroup + $Page->DisplayGroups - 1;
}

// Stop group <= total number of groups
if (intval($Page->StopGroup) > intval($Page->TotalGroups))
	$Page->StopGroup = $Page->TotalGroups;
$Page->RecordCount = 0;
$Page->RecordIndex = 0;

// Get first row
if ($Page->TotalGroups > 0) {
	$Page->loadRowValues(TRUE);
	$Page->GroupCount = 1;
}
$Page->GroupIndexes = InitArray(2, -1);
$Page->GroupIndexes[0] = -1;
$Page->GroupIndexes[1] = $Page->StopGroup - $Page->StartGroup + 1;
while ($Page->Recordset && !$Page->Recordset->EOF && $Page->GroupCount <= $Page->DisplayGroups || $Page->ShowHeader) {

	// Show dummy header for custom template
	// Show header

	if ($Page->ShowHeader) {
?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="gmp_rating_wise_feedback" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->rating->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="rating"><div class="rating_wise_feedback_rating"><span class="ew-table-header-caption"><?php echo $Page->rating->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="rating">
<?php if ($Page->sortUrl($Page->rating) == "") { ?>
		<div class="ew-table-header-btn rating_wise_feedback_rating">
			<span class="ew-table-header-caption"><?php echo $Page->rating->caption() ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_rating', form: 'frating_wise_feedbackrpt', name: 'rating_wise_feedback_rating', range: false, from: '<?php echo $Page->rating->RangeFrom; ?>', to: '<?php echo $Page->rating->RangeTo; ?>' });" id="x_rating<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer rating_wise_feedback_rating" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->rating) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->rating->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->rating->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->rating->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_rating', form: 'frating_wise_feedbackrpt', name: 'rating_wise_feedback_rating', range: false, from: '<?php echo $Page->rating->RangeFrom; ?>', to: '<?php echo $Page->rating->RangeTo; ?>' });" id="x_rating<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->f_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="f_name"><div class="rating_wise_feedback_f_name"><span class="ew-table-header-caption"><?php echo $Page->f_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="f_name">
<?php if ($Page->sortUrl($Page->f_name) == "") { ?>
		<div class="ew-table-header-btn rating_wise_feedback_f_name">
			<span class="ew-table-header-caption"><?php echo $Page->f_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer rating_wise_feedback_f_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->f_name) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->f_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->f_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->f_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->pro_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="pro_name"><div class="rating_wise_feedback_pro_name"><span class="ew-table-header-caption"><?php echo $Page->pro_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="pro_name">
<?php if ($Page->sortUrl($Page->pro_name) == "") { ?>
		<div class="ew-table-header-btn rating_wise_feedback_pro_name">
			<span class="ew-table-header-caption"><?php echo $Page->pro_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer rating_wise_feedback_pro_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->pro_name) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->pro_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->pro_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->pro_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->date_time->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="date_time"><div class="rating_wise_feedback_date_time"><span class="ew-table-header-caption"><?php echo $Page->date_time->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="date_time">
<?php if ($Page->sortUrl($Page->date_time) == "") { ?>
		<div class="ew-table-header-btn rating_wise_feedback_date_time">
			<span class="ew-table-header-caption"><?php echo $Page->date_time->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer rating_wise_feedback_date_time" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->date_time) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->date_time->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->date_time->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->date_time->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->details->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="details"><div class="rating_wise_feedback_details"><span class="ew-table-header-caption"><?php echo $Page->details->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="details">
<?php if ($Page->sortUrl($Page->details) == "") { ?>
		<div class="ew-table-header-btn rating_wise_feedback_details">
			<span class="ew-table-header-caption"><?php echo $Page->details->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer rating_wise_feedback_details" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->details) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->details->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->details->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->details->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Page->TotalGroups == 0) break; // Show header only
		$Page->ShowHeader = FALSE;
	}
	$Page->RecordCount++;
	$Page->RecordIndex++;
?>
<?php

		// Render detail row
		$Page->resetAttributes();
		$Page->RowType = ROWTYPE_DETAIL;
		$Page->renderRow();
?>
	<tr<?php echo $Page->rowAttributes(); ?>>
<?php if ($Page->rating->Visible) { ?>
		<td data-field="rating"<?php echo $Page->rating->cellAttributes() ?>>
<span<?php echo $Page->rating->viewAttributes() ?>><?php echo $Page->rating->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->f_name->Visible) { ?>
		<td data-field="f_name"<?php echo $Page->f_name->cellAttributes() ?>>
<span<?php echo $Page->f_name->viewAttributes() ?>><?php echo $Page->f_name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->pro_name->Visible) { ?>
		<td data-field="pro_name"<?php echo $Page->pro_name->cellAttributes() ?>>
<span<?php echo $Page->pro_name->viewAttributes() ?>><?php echo $Page->pro_name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->date_time->Visible) { ?>
		<td data-field="date_time"<?php echo $Page->date_time->cellAttributes() ?>>
<span<?php echo $Page->date_time->viewAttributes() ?>><?php echo $Page->date_time->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->details->Visible) { ?>
		<td data-field="details"<?php echo $Page->details->cellAttributes() ?>>
<span<?php echo $Page->details->viewAttributes() ?>><?php echo $Page->details->getViewValue() ?></span></td>
<?php } ?>
	</tr>
<?php

		// Accumulate page summary
		$Page->accumulateSummary();

		// Get next record
		$Page->loadRowValues();
	$Page->GroupCount++;
} // End while
?>
<?php if ($Page->TotalGroups > 0) { ?>
</tbody>
<tfoot>
	</tfoot>
<?php } elseif (!$Page->ShowHeader && TRUE) { // No header displayed ?>
<?php if ($Page->Export <> "pdf") { ?>
<?php if ($Page->Export == "word" || $Page->Export == "excel") { ?>
<div class="ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } else { ?>
<div class="card ew-card ew-grid"<?php echo $Page->ReportTableStyle ?>>
<?php } ?>
<?php } ?>
<!-- Report grid (begin) -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="gmp_rating_wise_feedback" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<?php } ?>
<?php if ($Page->TotalGroups > 0 || TRUE) { // Show footer ?>
</table>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php if ($Page->Export == "" && !($Page->DrillDown && $Page->TotalGroups > 0)) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php include "rating_wise_feedback_pager.php" ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<?php } ?>
<?php if ($Page->Export <> "pdf") { ?>
</div>
<?php } ?>
<!-- Summary Report Ends -->
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ($Page->Export == "" && !$DashboardReport) { ?>
</div>
<!-- /.ew-container -->
<?php } ?>
<?php
$Page->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php

// Close recordsets
if ($Page->GroupRecordset)
	$Page->GroupRecordset->Close();
if ($Page->Recordset)
	$Page->Recordset->Close();
?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<script>

// Write your table-specific startup script here
// console.log("page loaded");

</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "rfooter.php" ?>
<?php } ?>
<?php
$Page->terminate();
if (isset($OldPage))
	$Page = $OldPage;
?>