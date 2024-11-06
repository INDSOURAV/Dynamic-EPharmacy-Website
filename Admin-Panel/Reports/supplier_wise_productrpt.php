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
if (!isset($supplier_wise_product_rpt))
	$supplier_wise_product_rpt = new supplier_wise_product_rpt();
if (isset($Page))
	$OldPage = $Page;
$Page = &$supplier_wise_product_rpt;

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
echo "<br><center><b style='font-size:20px'>Supplier Wise Product Report</b></center><hr>";
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
var fsupplier_wise_productrpt = currentForm = new ew.Form("fsupplier_wise_productrpt");

// Validate method
fsupplier_wise_productrpt.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj), elm;

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate method
fsupplier_wise_productrpt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}
<?php if (CLIENT_VALIDATE) { ?>
fsupplier_wise_productrpt.validateRequired = true; // Uses JavaScript validation
<?php } else { ?>
fsupplier_wise_productrpt.validateRequired = false; // No JavaScript validation
<?php } ?>

// Use Ajax
fsupplier_wise_productrpt.lists["x_s_name"] = <?php echo $supplier_wise_product_rpt->s_name->Lookup->toClientList() ?>;
fsupplier_wise_productrpt.lists["x_s_name"].popupValues = <?php echo json_encode($supplier_wise_product_rpt->s_name->SelectionList) ?>;
fsupplier_wise_productrpt.lists["x_s_name"].popupOptions = <?php echo JsonEncode($supplier_wise_product_rpt->s_name->popupOptions()) ?>;
fsupplier_wise_productrpt.lists["x_s_name"].options = <?php echo JsonEncode($supplier_wise_product_rpt->s_name->lookupOptions()) ?>;
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
<div id="ew-center" class="<?php echo $supplier_wise_product_rpt->CenterContentClass ?>">
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
<form name="fsupplier_wise_productrpt" id="fsupplier_wise_productrpt" class="form-inline ew-form ew-ext-filter-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($Page->Filter <> "") ? " show" : " show"; ?>
<div id="fsupplier_wise_productrpt-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<div id="r_1" class="ew-row d-sm-flex">
<div id="c_s_name" class="ew-cell form-group">
	<label for="x_s_name" class="ew-search-caption ew-label"><?php echo $Page->s_name->caption() ?></label>
	<span class="ew-search-field">
<?php $Page->s_name->EditAttrs["onchange"] = "ew.forms(this).submit(); " . @$Page->s_name->EditAttrs["onchange"]; ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="supplier_wise_product" data-field="x_s_name" data-value-separator="<?php echo $Page->s_name->displayValueSeparatorAttribute() ?>" id="x_s_name" name="x_s_name"<?php echo $Page->s_name->editAttributes() ?>>
		<?php echo $Page->s_name->selectOptionListHtml("x_s_name") ?>
	</select>
</div>
<?php echo $Page->s_name->Lookup->getParamTag("p_x_s_name") ?>
</span>
</div>
</div>
</div>
</form>
<script>
fsupplier_wise_productrpt.filterList = <?php echo $Page->getFilterList() ?>;
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
<div id="gmp_supplier_wise_product" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Page->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Page->s_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="s_name"><div class="supplier_wise_product_s_name"><span class="ew-table-header-caption"><?php echo $Page->s_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="s_name">
<?php if ($Page->sortUrl($Page->s_name) == "") { ?>
		<div class="ew-table-header-btn supplier_wise_product_s_name">
			<span class="ew-table-header-caption"><?php echo $Page->s_name->caption() ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_s_name', form: 'fsupplier_wise_productrpt', name: 'supplier_wise_product_s_name', range: false, from: '<?php echo $Page->s_name->RangeFrom; ?>', to: '<?php echo $Page->s_name->RangeTo; ?>' });" id="x_s_name<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer supplier_wise_product_s_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->s_name) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->s_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->s_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->s_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
	<?php if (!$DashboardReport) { ?>
			<a class="ew-table-header-popup" title="<?php echo $ReportLanguage->phrase("Filter"); ?>" onclick="ew.showPopup.call(this, event, { id: 'x_s_name', form: 'fsupplier_wise_productrpt', name: 'supplier_wise_product_s_name', range: false, from: '<?php echo $Page->s_name->RangeFrom; ?>', to: '<?php echo $Page->s_name->RangeTo; ?>' });" id="x_s_name<?php echo $Page->Counts[0][0]; ?>"><span class="icon-filter"></span></a>
	<?php } ?>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->pro_name->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="pro_name"><div class="supplier_wise_product_pro_name"><span class="ew-table-header-caption"><?php echo $Page->pro_name->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="pro_name">
<?php if ($Page->sortUrl($Page->pro_name) == "") { ?>
		<div class="ew-table-header-btn supplier_wise_product_pro_name">
			<span class="ew-table-header-caption"><?php echo $Page->pro_name->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer supplier_wise_product_pro_name" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->pro_name) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->pro_name->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->pro_name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->pro_name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->price->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="price"><div class="supplier_wise_product_price"><span class="ew-table-header-caption"><?php echo $Page->price->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="price">
<?php if ($Page->sortUrl($Page->price) == "") { ?>
		<div class="ew-table-header-btn supplier_wise_product_price">
			<span class="ew-table-header-caption"><?php echo $Page->price->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer supplier_wise_product_price" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->price) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->price->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->price->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->price->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php } ?>
<?php if ($Page->qty->Visible) { ?>
<?php if ($Page->Export <> "" || $Page->DrillDown) { ?>
	<td data-field="qty"><div class="supplier_wise_product_qty"><span class="ew-table-header-caption"><?php echo $Page->qty->caption() ?></span></div></td>
<?php } else { ?>
	<td data-field="qty">
<?php if ($Page->sortUrl($Page->qty) == "") { ?>
		<div class="ew-table-header-btn supplier_wise_product_qty">
			<span class="ew-table-header-caption"><?php echo $Page->qty->caption() ?></span>
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer supplier_wise_product_qty" onclick="ew.sort(event,'<?php echo $Page->sortUrl($Page->qty) ?>',2);">
			<span class="ew-table-header-caption"><?php echo $Page->qty->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Page->qty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($Page->qty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span>
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
<?php if ($Page->s_name->Visible) { ?>
		<td data-field="s_name"<?php echo $Page->s_name->cellAttributes() ?>>
<span<?php echo $Page->s_name->viewAttributes() ?>><?php echo $Page->s_name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->pro_name->Visible) { ?>
		<td data-field="pro_name"<?php echo $Page->pro_name->cellAttributes() ?>>
<span<?php echo $Page->pro_name->viewAttributes() ?>><?php echo $Page->pro_name->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->price->Visible) { ?>
		<td data-field="price"<?php echo $Page->price->cellAttributes() ?>>
<span<?php echo $Page->price->viewAttributes() ?>><?php echo $Page->price->getViewValue() ?></span></td>
<?php } ?>
<?php if ($Page->qty->Visible) { ?>
		<td data-field="qty"<?php echo $Page->qty->cellAttributes() ?>>
<span<?php echo $Page->qty->viewAttributes() ?>><?php echo $Page->qty->getViewValue() ?></span></td>
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
<div id="gmp_supplier_wise_product" class="<?php if (IsResponsiveLayout()) { echo "table-responsive "; } ?>ew-grid-middle-panel">
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
<?php include "supplier_wise_product_pager.php" ?>
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