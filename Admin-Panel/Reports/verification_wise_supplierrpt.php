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
if (!isset($verification_wise_supplier_rpt))
	$verification_wise_supplier_rpt = new verification_wise_supplier_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$verification_wise_supplier_rpt;

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
var fverification_wise_supplierrpt = currentForm = new ew.Form("fverification_wise_supplierrpt");

// Validate method
fverification_wise_supplierrpt.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj), elm;

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
fverification_wise_supplierrpt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}
<?php if (CLIENT_VALIDATE) { ?>
fverification_wise_supplierrpt.validateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fverification_wise_supplierrpt.validateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
fverification_wise_supplierrpt.lists["x_is_verified"] = <?php echo $verification_wise_supplier_rpt->is_verified->Lookup->toClientList() ?>;
fverification_wise_supplierrpt.lists["x_is_verified"].popupValues = <?php echo json_encode($verification_wise_supplier_rpt->is_verified->SelectionList) ?>;
fverification_wise_supplierrpt.lists["x_is_verified"].popupOptions = <?php echo JsonEncode($verification_wise_supplier_rpt->is_verified->popupOptions()) ?>;
fverification_wise_supplierrpt.lists["x_is_verified"].options = <?php echo JsonEncode($verification_wise_supplier_rpt->is_verified->lookupOptions()) ?>;
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
<div id="ew-center" class="<?php echo $verification_wise_supplier_rpt->CenterContentClass ?>">
<?php } ?>
<!-- Summary Report begins -->
<?php if ($Page->Export <> "pdf") { ?>
<div id="report_summary">
<?php } ?>
<?php if ($Page->Export == "" && !$Page->DrillDown && !$DashboardReport) { ?>
<!-- Search form (begin) -->
<?php

	// Render search row
	$Page->resetAttributes();
	$Page->RowType = ROWTYPE_SEARCH;
	$Page->renderRow();
?>
<form name="fverification_wise_supplierrpt" id="fverification_wise_supplierrpt" class="form-inline ew-form ew-ext-filter-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
<div id="fverification_wise_supplierrpt-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ew-row d-sm-flex">
<div id="c_is_verified" class="ew-cell form-group">
	<label for="x_is_verified" class="ew-search-caption ew-label"><?php echo $Page->is_verified->caption() ?></label>
	<span class="ew-search-field">
<?php $Page->is_verified->EditAttrs["onchange"] = "ew.forms(this).submit(); " . @$Page->is_verified->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="verification_wise_supplier" data-field="x_is_verified" data-value-separator="<?php echo $Page->is_verified->displayValueSeparatorAttribute() ?>" id="x_is_verified" name="x_is_verified"<?php echo $Page->is_verified->editAttributes() ?>>
		<?php echo $Page->is_verified->selectOptionListHtml("x_is_verified") ?>
	</select>
</div>
<?php echo $Page->is_verified->Lookup->getParamTag("p_x_is_verified") ?>
</span>
</div>
</div>
</div>
</form>
<script>
fverification_wise_supplierrpt.filterList = <?php echo $Page->getFilterList() ?>;
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
<div id="gmp_verification_wise_supplier" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->is_verified->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="is_verified"><div class="verification_wise_supplier_is_verified"><span class="ew-table-header-caption"><?php echo $Page->is_verified->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="is_verified">
<?php if ($Page->sortUrl($Page->is_verified) == "") { ?>
		<div class="ew-table-header-btn verification_wise_supplier_is_verified">
			<span class="ew-table-header-caption"><?php echo $Page->is_verified->caption() ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_is_verified', form: 'fverification_wise_supplierrpt', name: 'verification_wise_supplier_is_verified', range: false, from: '<?php echo $Page->is_verified->RangeFrom; ?>', to: '<?php echo $Page->is_verified->RangeTo; ?>' });" id="x_is_verified<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer verification_wise_supplier_is_verified" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->is_verified) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->is_verified->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->is_verified->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->is_verified->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_is_verified', form: 'fverification_wise_supplierrpt', name: 'verification_wise_supplier_is_verified', range: false, from: '<?php echo $Page->is_verified->RangeFrom; ?>', to: '<?php echo $Page->is_verified->RangeTo; ?>' });" id="x_is_verified<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->s_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="s_name"><div class="verification_wise_supplier_s_name"><span class="ew-table-header-caption"><?php echo $Page->s_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="s_name">
<?php if ($Page->sortUrl($Page->s_name) == "") { ?>
		<div class="ew-table-header-btn verification_wise_supplier_s_name">
			<span class="ew-table-header-caption"><?php echo $Page->s_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer verification_wise_supplier_s_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->s_name) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->s_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->s_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->s_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->mobile_no->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="mobile_no"><div class="verification_wise_supplier_mobile_no"><span class="ew-table-header-caption"><?php echo $Page->mobile_no->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="mobile_no">
<?php if ($Page->sortUrl($Page->mobile_no) == "") { ?>
		<div class="ew-table-header-btn verification_wise_supplier_mobile_no">
			<span class="ew-table-header-caption"><?php echo $Page->mobile_no->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer verification_wise_supplier_mobile_no" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->mobile_no) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->mobile_no->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->mobile_no->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->mobile_no->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->_email->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="_email"><div class="verification_wise_supplier__email"><span class="ew-table-header-caption"><?php echo $Page->_email->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="_email">
<?php if ($Page->sortUrl($Page->_email) == "") { ?>
		<div class="ew-table-header-btn verification_wise_supplier__email">
			<span class="ew-table-header-caption"><?php echo $Page->_email->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer verification_wise_supplier__email" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->_email) ?>',2);">
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
<?php if ($Page->is_verified->Visible) { ?>
		<td data-field="is_verified"<?php echo $Page->is_verified->cellAttributes() ?>>
<span<?php echo $Page->is_verified->viewAttributes() ?>><?php echo $Page->is_verified->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->s_name->Visible) { ?>
		<td data-field="s_name"<?php echo $Page->s_name->cellAttributes() ?>>
<span<?php echo $Page->s_name->viewAttributes() ?>><?php echo $Page->s_name->getViewValue() ?></span></td>
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
<div id="gmp_verification_wise_supplier" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
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
<?php include "verification_wise_supplier_pager.php" ?>
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