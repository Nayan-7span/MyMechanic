<?php

// Global variable for table object
$service_status = NULL;

//
// Table class for service status
//
class crservice_status extends crTableBase {
	var $ShowGroupHeaderAsRow = FALSE;
	var $ShowCompactSummaryFooter = TRUE;
	var $s_id;
	var $cat_id;
	var $s_name;
	var $s_image;
	var $s_description;
	var $s_special1;
	var $s_special2;
	var $s_special3;
	var $s_price;
	var $s_by;
	var $s_status;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage, $gsLanguage;
		$this->TableVar = 'service_status';
		$this->TableName = 'service status';
		$this->TableType = 'VIEW';
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0;

		// s_id
		$this->s_id = new crField('service_status', 'service status', 'x_s_id', 's_id', '`s_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->s_id->Sortable = TRUE; // Allow sort
		$this->s_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['s_id'] = &$this->s_id;
		$this->s_id->DateFilter = "";
		$this->s_id->SqlSelect = "";
		$this->s_id->SqlOrderBy = "";

		// cat_id
		$this->cat_id = new crField('service_status', 'service status', 'x_cat_id', 'cat_id', '`cat_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->cat_id->Sortable = TRUE; // Allow sort
		$this->cat_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['cat_id'] = &$this->cat_id;
		$this->cat_id->DateFilter = "";
		$this->cat_id->SqlSelect = "";
		$this->cat_id->SqlOrderBy = "";

		// s_name
		$this->s_name = new crField('service_status', 'service status', 'x_s_name', 's_name', '`s_name`', 200, EWR_DATATYPE_STRING, -1);
		$this->s_name->Sortable = TRUE; // Allow sort
		$this->fields['s_name'] = &$this->s_name;
		$this->s_name->DateFilter = "";
		$this->s_name->SqlSelect = "";
		$this->s_name->SqlOrderBy = "";

		// s_image
		$this->s_image = new crField('service_status', 'service status', 'x_s_image', 's_image', '`s_image`', 205, EWR_DATATYPE_BLOB, -1);
		$this->s_image->Sortable = TRUE; // Allow sort
		$this->fields['s_image'] = &$this->s_image;
		$this->s_image->DateFilter = "";
		$this->s_image->SqlSelect = "";
		$this->s_image->SqlOrderBy = "";

		// s_description
		$this->s_description = new crField('service_status', 'service status', 'x_s_description', 's_description', '`s_description`', 200, EWR_DATATYPE_STRING, -1);
		$this->s_description->Sortable = TRUE; // Allow sort
		$this->fields['s_description'] = &$this->s_description;
		$this->s_description->DateFilter = "";
		$this->s_description->SqlSelect = "";
		$this->s_description->SqlOrderBy = "";

		// s_special1
		$this->s_special1 = new crField('service_status', 'service status', 'x_s_special1', 's_special1', '`s_special1`', 200, EWR_DATATYPE_STRING, -1);
		$this->s_special1->Sortable = TRUE; // Allow sort
		$this->fields['s_special1'] = &$this->s_special1;
		$this->s_special1->DateFilter = "";
		$this->s_special1->SqlSelect = "";
		$this->s_special1->SqlOrderBy = "";

		// s_special2
		$this->s_special2 = new crField('service_status', 'service status', 'x_s_special2', 's_special2', '`s_special2`', 200, EWR_DATATYPE_STRING, -1);
		$this->s_special2->Sortable = TRUE; // Allow sort
		$this->fields['s_special2'] = &$this->s_special2;
		$this->s_special2->DateFilter = "";
		$this->s_special2->SqlSelect = "";
		$this->s_special2->SqlOrderBy = "";

		// s_special3
		$this->s_special3 = new crField('service_status', 'service status', 'x_s_special3', 's_special3', '`s_special3`', 200, EWR_DATATYPE_STRING, -1);
		$this->s_special3->Sortable = TRUE; // Allow sort
		$this->fields['s_special3'] = &$this->s_special3;
		$this->s_special3->DateFilter = "";
		$this->s_special3->SqlSelect = "";
		$this->s_special3->SqlOrderBy = "";

		// s_price
		$this->s_price = new crField('service_status', 'service status', 'x_s_price', 's_price', '`s_price`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->s_price->Sortable = TRUE; // Allow sort
		$this->s_price->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['s_price'] = &$this->s_price;
		$this->s_price->DateFilter = "";
		$this->s_price->SqlSelect = "";
		$this->s_price->SqlOrderBy = "";

		// s_by
		$this->s_by = new crField('service_status', 'service status', 'x_s_by', 's_by', '`s_by`', 200, EWR_DATATYPE_STRING, -1);
		$this->s_by->Sortable = TRUE; // Allow sort
		$this->fields['s_by'] = &$this->s_by;
		$this->s_by->DateFilter = "";
		$this->s_by->SqlSelect = "";
		$this->s_by->SqlOrderBy = "";

		// s_status
		$this->s_status = new crField('service_status', 'service status', 'x_s_status', 's_status', '`s_status`', 200, EWR_DATATYPE_STRING, -1);
		$this->s_status->Sortable = TRUE; // Allow sort
		$this->fields['s_status'] = &$this->s_status;
		$this->s_status->DateFilter = "";
		$this->s_status->SqlSelect = "SELECT DISTINCT `s_status`, `s_status` AS `DispFld` FROM " . $this->getSqlFrom();
		$this->s_status->SqlOrderBy = "`s_status`";
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ofld->GroupingFieldId == 0) {
				if ($ctrl) {
					$sOrderBy = $this->getDetailOrderBy();
					if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
						$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
					} else {
						if ($sOrderBy <> "") $sOrderBy .= ", ";
						$sOrderBy .= $sSortField . " " . $sThisSort;
					}
					$this->setDetailOrderBy($sOrderBy); // Save to Session
				} else {
					$this->setDetailOrderBy($sSortField . " " . $sThisSort); // Save to Session
				}
			}
		} else {
			if ($ofld->GroupingFieldId == 0 && !$ctrl) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				$fldsql = $fld->FldExpression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	// From

	var $_SqlFrom = "";

	function getSqlFrom() {
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`service status`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}

	// Select
	var $_SqlSelect = "";

	function getSqlSelect() {
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}

	// Where
	var $_SqlWhere = "";

	function getSqlWhere() {
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}

	// Group By
	var $_SqlGroupBy = "";

	function getSqlGroupBy() {
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}

	// Having
	var $_SqlHaving = "";

	function getSqlHaving() {
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}

	// Order By
	var $_SqlOrderBy = "";

	function getSqlOrderBy() {
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Select Aggregate
	var $_SqlSelectAgg = "";

	function getSqlSelectAgg() {
		return ($this->_SqlSelectAgg <> "") ? $this->_SqlSelectAgg : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelectAgg() { // For backward compatibility
		return $this->getSqlSelectAgg();
	}

	function setSqlSelectAgg($v) {
		$this->_SqlSelectAgg = $v;
	}

	// Aggregate Prefix
	var $_SqlAggPfx = "";

	function getSqlAggPfx() {
		return ($this->_SqlAggPfx <> "") ? $this->_SqlAggPfx : "";
	}

	function SqlAggPfx() { // For backward compatibility
		return $this->getSqlAggPfx();
	}

	function setSqlAggPfx($v) {
		$this->_SqlAggPfx = $v;
	}

	// Aggregate Suffix
	var $_SqlAggSfx = "";

	function getSqlAggSfx() {
		return ($this->_SqlAggSfx <> "") ? $this->_SqlAggSfx : "";
	}

	function SqlAggSfx() { // For backward compatibility
		return $this->getSqlAggSfx();
	}

	function setSqlAggSfx($v) {
		$this->_SqlAggSfx = $v;
	}

	// Select Count
	var $_SqlSelectCount = "";

	function getSqlSelectCount() {
		return ($this->_SqlSelectCount <> "") ? $this->_SqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}

	function SqlSelectCount() { // For backward compatibility
		return $this->getSqlSelectCount();
	}

	function setSqlSelectCount($v) {
		$this->_SqlSelectCount = $v;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {

			//$sUrlParm = "order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort();
			$sUrlParm = "order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort();
			return ewr_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		case "x_s_status":
			$sSqlWrk = "";
		$sSqlWrk = "SELECT DISTINCT `s_status`, `s_status` AS `DispFld`, '' AS `DispFld2`, '' AS `DispFld3`, '' AS `DispFld4` FROM `service status`";
		$sWhereWrk = "";
		$this->s_status->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "DB", "f0" => '`s_status` = {filter_value}', "t0" => "200", "fn0" => "", "dlm" => ewr_Encrypt($fld->FldDelimiter));
			$sSqlWrk = "";
		$this->Lookup_Selecting($this->s_status, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `s_status` ASC";
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		}
	}

	// Table level events
	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["style"] = "xxx";

	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // With function, or
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//ewr_UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->FldName == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->FldName == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->FldName == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->FldName == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}
}
?>
