<?php

// Global variable for table object
$service_vise_booking = NULL;

//
// Table class for service vise booking
//
class crservice_vise_booking extends crTableBase {
	var $ShowGroupHeaderAsRow = FALSE;
	var $ShowCompactSummaryFooter = TRUE;
	var $s_name;
	var $cr_id;
	var $gr_id;
	var $bk_date;
	var $sr_date;
	var $sr_city;
	var $car_model;
	var $sr_by;
	var $bk_status;
	var $pay_status;
	var $car_no;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage, $gsLanguage;
		$this->TableVar = 'service_vise_booking';
		$this->TableName = 'service vise booking';
		$this->TableType = 'VIEW';
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0;

		// s_name
		$this->s_name = new crField('service_vise_booking', 'service vise booking', 'x_s_name', 's_name', '`s_name`', 200, EWR_DATATYPE_STRING, -1);
		$this->s_name->Sortable = TRUE; // Allow sort
		$this->fields['s_name'] = &$this->s_name;
		$this->s_name->DateFilter = "";
		$this->s_name->SqlSelect = "SELECT DISTINCT `s_name`, `s_name` AS `DispFld` FROM " . $this->getSqlFrom();
		$this->s_name->SqlOrderBy = "`s_name`";

		// cr_id
		$this->cr_id = new crField('service_vise_booking', 'service vise booking', 'x_cr_id', 'cr_id', '`cr_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->cr_id->Sortable = TRUE; // Allow sort
		$this->cr_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['cr_id'] = &$this->cr_id;
		$this->cr_id->DateFilter = "";
		$this->cr_id->SqlSelect = "";
		$this->cr_id->SqlOrderBy = "";

		// gr_id
		$this->gr_id = new crField('service_vise_booking', 'service vise booking', 'x_gr_id', 'gr_id', '`gr_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->gr_id->Sortable = TRUE; // Allow sort
		$this->gr_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['gr_id'] = &$this->gr_id;
		$this->gr_id->DateFilter = "";
		$this->gr_id->SqlSelect = "";
		$this->gr_id->SqlOrderBy = "";

		// bk_date
		$this->bk_date = new crField('service_vise_booking', 'service vise booking', 'x_bk_date', 'bk_date', '`bk_date`', 133, EWR_DATATYPE_DATE, 0);
		$this->bk_date->Sortable = TRUE; // Allow sort
		$this->bk_date->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['bk_date'] = &$this->bk_date;
		$this->bk_date->DateFilter = "";
		$this->bk_date->SqlSelect = "";
		$this->bk_date->SqlOrderBy = "";

		// sr_date
		$this->sr_date = new crField('service_vise_booking', 'service vise booking', 'x_sr_date', 'sr_date', '`sr_date`', 135, EWR_DATATYPE_DATE, 0);
		$this->sr_date->Sortable = TRUE; // Allow sort
		$this->sr_date->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['sr_date'] = &$this->sr_date;
		$this->sr_date->DateFilter = "";
		$this->sr_date->SqlSelect = "";
		$this->sr_date->SqlOrderBy = "";

		// sr_city
		$this->sr_city = new crField('service_vise_booking', 'service vise booking', 'x_sr_city', 'sr_city', '`sr_city`', 200, EWR_DATATYPE_STRING, -1);
		$this->sr_city->Sortable = TRUE; // Allow sort
		$this->fields['sr_city'] = &$this->sr_city;
		$this->sr_city->DateFilter = "";
		$this->sr_city->SqlSelect = "";
		$this->sr_city->SqlOrderBy = "";

		// car_model
		$this->car_model = new crField('service_vise_booking', 'service vise booking', 'x_car_model', 'car_model', '`car_model`', 200, EWR_DATATYPE_STRING, -1);
		$this->car_model->Sortable = TRUE; // Allow sort
		$this->fields['car_model'] = &$this->car_model;
		$this->car_model->DateFilter = "";
		$this->car_model->SqlSelect = "";
		$this->car_model->SqlOrderBy = "";

		// sr_by
		$this->sr_by = new crField('service_vise_booking', 'service vise booking', 'x_sr_by', 'sr_by', '`sr_by`', 200, EWR_DATATYPE_STRING, -1);
		$this->sr_by->Sortable = TRUE; // Allow sort
		$this->fields['sr_by'] = &$this->sr_by;
		$this->sr_by->DateFilter = "";
		$this->sr_by->SqlSelect = "";
		$this->sr_by->SqlOrderBy = "";

		// bk_status
		$this->bk_status = new crField('service_vise_booking', 'service vise booking', 'x_bk_status', 'bk_status', '`bk_status`', 200, EWR_DATATYPE_STRING, -1);
		$this->bk_status->Sortable = TRUE; // Allow sort
		$this->fields['bk_status'] = &$this->bk_status;
		$this->bk_status->DateFilter = "";
		$this->bk_status->SqlSelect = "";
		$this->bk_status->SqlOrderBy = "";

		// pay_status
		$this->pay_status = new crField('service_vise_booking', 'service vise booking', 'x_pay_status', 'pay_status', '`pay_status`', 200, EWR_DATATYPE_STRING, -1);
		$this->pay_status->Sortable = TRUE; // Allow sort
		$this->fields['pay_status'] = &$this->pay_status;
		$this->pay_status->DateFilter = "";
		$this->pay_status->SqlSelect = "";
		$this->pay_status->SqlOrderBy = "";

		// car_no
		$this->car_no = new crField('service_vise_booking', 'service vise booking', 'x_car_no', 'car_no', '`car_no`', 200, EWR_DATATYPE_STRING, -1);
		$this->car_no->Sortable = TRUE; // Allow sort
		$this->fields['car_no'] = &$this->car_no;
		$this->car_no->DateFilter = "";
		$this->car_no->SqlSelect = "";
		$this->car_no->SqlOrderBy = "";
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`service vise booking`";
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
		case "x_s_name":
			$sSqlWrk = "";
		$sSqlWrk = "SELECT DISTINCT `s_name`, `s_name` AS `DispFld`, '' AS `DispFld2`, '' AS `DispFld3`, '' AS `DispFld4` FROM `service vise booking`";
		$sWhereWrk = "";
		$this->s_name->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "DB", "f0" => '`s_name` = {filter_value}', "t0" => "200", "fn0" => "", "dlm" => ewr_Encrypt($fld->FldDelimiter));
			$sSqlWrk = "";
		$this->Lookup_Selecting($this->s_name, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `s_name` ASC";
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
