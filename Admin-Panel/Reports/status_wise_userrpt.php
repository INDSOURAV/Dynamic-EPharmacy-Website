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
if (!isset($status_wise_user_rpt))
	$status_wise_user_rpt = new status_wise_user_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$status_wise_user_rpt;

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
echo "<br><center><b style='font-size:20px'>Status Wise User Report</b></center><hr>";
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
var fstatus_wise_userrpt = currentForm = new ew.Form("fstatus_wise_userrpt");

// Validate method
fstatus_wise_userrpt.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj), elm;

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
fstatus_wise_userrpt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}
<?php if (CLIENT_VALIDATE) { ?>
fstatus_wise_userrpt.validateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fstatus_wise_userrpt.validateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
fstatus_wise_userrpt.lists["x_c_status"] = <?php echo $status_wise_user_rpt->c_status->Lookup->toClientList() ?>;
fstatus_wise_userrpt.lists["x_c_status"].popupValues = <?php echo json_encode($status_wise_user_rpt->c_status->SelectionList) ?>;
fstatus_wise_userrpt.lists["x_c_status"].popupOptions = <?php echo JsonEncode($status_wise_user_rpt->c_status->popupOptions()) ?>;
fstatus_wise_userrpt.lists["x_c_status"].options = <?php echo JsonEncode($status_wise_user_rpt->c_status->lookupOptions()) ?>;
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
<div id="ew-center" class="<?php echo $status_wise_user_rpt->CenterContentClass ?>">
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
<form name="fstatus_wise_userrpt" id="fstatus_wise_userrpt" class="form-inline ew-form ew-ext-filter-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
<div id="fstatus_wise_userrpt-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ew-row d-sm-flex">
<div id="c_c_status" class="ew-cell form-group">
	<label for="x_c_status" class="ew-search-caption ew-label"><?php echo $Page->c_status->caption() ?></label>
	<span class="ew-search-field">
<?php $Page->c_status->EditAttrs["onchange"] = "ew.forms(this).submit(); " . @$Page->c_status->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="status_wise_user" data-field="x_c_status" data-value-separator="<?php echo $Page->c_status->displayValueSeparatorAttribute() ?>" id="x_c_status" name="x_c_status"<?php echo $Page->c_status->editAttributes() ?>>
		<?php echo $Page->c_status->selectOptionListHtml("x_c_status") ?>
	</select>
</div>
<?php echo $Page->c_status->Lookup->getParamTag("p_x_c_status") ?>
</span>
</div>
</div>
</div>
</form>
<script>
fstatus_wise_userrpt.filterList = <?php echo $Page->getFilterList() ?>;
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
<div id="gmp_status_wise_user" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->c_status->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="c_status"><div class="status_wise_user_c_status"><span class="ew-table-header-caption"><?php echo $Page->c_status->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="c_status">
<?php if ($Page->sortUrl($Page->c_status) == "") { ?>
		<div class="ew-table-header-btn status_wise_user_c_status">
			<span class="ew-table-header-caption"><?php echo $Page->c_status->caption() ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_c_status', form: 'fstatus_wise_userrpt', name: 'status_wise_user_c_status', range: false, from: '<?php echo $Page->c_status->RangeFrom; ?>', to: '<?php echo $Page->c_status->RangeTo; ?>' });" id="x_c_status<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer status_wise_user_c_status" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->c_status) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->c_status->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->c_status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->c_status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_c_status', form: 'fstatus_wise_userrpt', name: 'status_wise_user_c_status', range: false, from: '<?php echo $Page->c_status->RangeFrom; ?>', to: '<?php echo $Page->c_status->RangeTo; ?>' });" id="x_c_status<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->s_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="s_name"><div class="status_wise_user_s_name"><span class="ew-table-header-caption"><?php echo $Page->s_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="s_name">
<?php if ($Page->sortUrl($Page->s_name) == "") { ?>
		<div class="ew-table-header-btn status_wise_user_s_name">
			<span class="ew-table-header-caption"><?php echo $Page->s_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer status_wise_user_s_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->s_name) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->s_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->s_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->s_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->f_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="f_name"><div class="status_wise_user_f_name"><span class="ew-table-header-caption"><?php echo $Page->f_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="f_name">
<?php if ($Page->sortUrl($Page->f_name) == "") { ?>
		<div class="ew-table-header-btn status_wise_user_f_name">
			<span class="ew-table-header-caption"><?php echo $Page->f_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer status_wise_user_f_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->f_name) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->f_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->f_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->f_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->m_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="m_name"><div class="status_wise_user_m_name"><span class="ew-table-header-caption"><?php echo $Page->m_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="m_name">
<?php if ($Page->sortUrl($Page->m_name) == "") { ?>
		<div class="ew-table-header-btn status_wise_user_m_name">
			<span class="ew-table-header-caption"><?php echo $Page->m_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer status_wise_user_m_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->m_name) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->m_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->m_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->m_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->l_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="l_name"><div class="status_wise_user_l_name"><span class="ew-table-header-caption"><?php echo $Page->l_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="l_name">
<?php if ($Page->sortUrl($Page->l_name) == "") { ?>
		<div class="ew-table-header-btn status_wise_user_l_name">
			<span class="ew-table-header-caption"><?php echo $Page->l_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer status_wise_user_l_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->l_name) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->l_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->l_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->l_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->mobile_no->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="mobile_no"><div class="status_wise_user_mobile_no"><span class="ew-table-header-caption"><?php echo $Page->mobile_no->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="mobile_no">
<?php if ($Page->sortUrl($Page->mobile_no) == "") { ?>
		<div class="ew-table-header-btn status_wise_user_mobile_no">
			<span class="ew-table-header-caption"><?php echo $Page->mobile_no->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer status_wise_user_mobile_no" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->mobile_no) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->mobile_no->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->mobile_no->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->mobile_no->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->_email->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="_email"><div class="status_wise_user__email"><span class="ew-table-header-caption"><?php echo $Page->_email->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="_email">
<?php if ($Page->sortUrl($Page->_email) == "") { ?>
		<div class="ew-table-header-btn status_wise_user__email">
			<span class="ew-table-header-caption"><?php echo $Page->_email->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer status_wise_user__email" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->_email) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->_email->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->_email->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->_email->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
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
<?php if ($Page->c_status->Visible) { ?>
		<td data-field="c_status"<?php echo $Page->c_status->cellAttributes() ?>>
<span<?php echo $Page->c_status->viewAttributes() ?>><?php echo $Page->c_status->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->s_name->Visible) { ?>
		<td data-field="s_name"<?php echo $Page->s_name->cellAttributes() ?>>
<span<?php echo $Page->s_name->viewAttributes() ?>><?php echo $Page->s_name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->f_name->Visible) { ?>
		<td data-field="f_name"<?php echo $Page->f_name->cellAttributes() ?>>
<span<?php echo $Page->f_name->viewAttributes() ?>><?php echo $Page->f_name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->m_name->Visible) { ?>
		<td data-field="m_name"<?php echo $Page->m_name->cellAttributes() ?>>
<span<?php echo $Page->m_name->viewAttributes() ?>><?php echo $Page->m_name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->l_name->Visible) { ?>
		<td data-field="l_name"<?php echo $Page->l_name->cellAttributes() ?>>
<span<?php echo $Page->l_name->viewAttributes() ?>><?php echo $Page->l_name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->mobile_no->Visible) { ?>
		<td data-field="mobile_no"<?php echo $Page->mobile_no->cellAttributes() ?>>
<span<?php echo $Page->mobile_no->viewAttributes() ?>><?php echo $Page->mobile_no->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->_email->Visible) { ?>
		<td data-field="_email"<?php echo $Page->_email->cellAttributes() ?>>
<span<?php echo $Page->_email->viewAttributes() ?>><?php echo $Page->_email->getViewValue() ?></span></td>
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
<div id="gmp_status_wise_user" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
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
<?php include "status_wise_user_pager.php" ?>
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