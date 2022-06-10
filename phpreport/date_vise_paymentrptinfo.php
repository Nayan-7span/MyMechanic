<?php

// Global variable for table object
$date_vise_payment = NULL;

//
// Table class for date vise payment
//
class crdate_vise_payment extends crTableBase {
	var $ShowGroupHeaderAsRow = FALSE;
	var $ShowCompactSummaryFooter = TRUE;
	var $bk_id;
	var $cr_id;
	var $gr_id;
	var $pay_id;
	var $pay_bank;
	var $pay_mode;
	var $banktrxid;
	var $pay_amount;
	var $pay_date;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage, $gsLanguage;
		$this->TableVar = 'date_vise_payment';
		$this->TableName = 'date vise payment';
		$this->TableType = 'VIEW';
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0;

		// bk_id
		$this->bk_id = new crField('date_vise_payment', 'date vise payment', 'x_bk_id', 'bk_id', '`bk_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->bk_id->Sortable = TRUE; // Allow sort
		$this->bk_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['bk_id'] = &$this->bk_id;
		$this->bk_id->DateFilter = "";
		$this->bk_id->SqlSelect = "";
		$this->bk_id->SqlOrderBy = "";

		// cr_id
		$this->cr_id = new crField('date_vise_payment', 'date vise payment', 'x_cr_id', 'cr_id', '`cr_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->cr_id->Sortable = TRUE; // Allow sort
		$this->cr_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['cr_id'] = &$this->cr_id;
		$this->cr_id->DateFilter = "";
		$this->cr_id->SqlSelect = "";
		$this->cr_id->SqlOrderBy = "";

		// gr_id
		$this->gr_id = new crField('date_vise_payment', 'date vise payment', 'x_gr_id', 'gr_id', '`gr_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->gr_id->Sortable = TRUE; // Allow sort
		$this->gr_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['gr_id'] = &$this->gr_id;
		$this->gr_id->DateFilter = "";
		$this->gr_id->SqlSelect = "";
		$this->gr_id->SqlOrderBy = "";

		// pay_id
		$this->pay_id = new crField('date_vise_payment', 'date vise payment', 'x_pay_id', 'pay_id', '`pay_id`', 200, EWR_DATATYPE_STRING, -1);
		$this->pay_id->Sortable = TRUE; // Allow sort
		$this->fields['pay_id'] = &$this->pay_id;
		$this->pay_id->DateFilter = "";
		$this->pay_id->SqlSelect = "";
		$this->pay_id->SqlOrderBy = "";

		// pay_bank
		$this->pay_bank = new crField('date_vise_payment', 'date vise payment', 'x_pay_bank', 'pay_bank', '`pay_bank`', 200, EWR_DATATYPE_STRING, -1);
		$this->pay_bank->Sortable = TRUE; // Allow sort
		$this->fields['pay_bank'] = &$this->pay_bank;
		$this->pay_bank->DateFilter = "";
		$this->pay_bank->SqlSelect = "";
		$this->pay_bank->SqlOrderBy = "";

		// pay_mode
		$this->pay_mode = new crField('date_vise_payment', 'date vise payment', 'x_pay_mode', 'pay_mode', '`pay_mode`', 200, EWR_DATATYPE_STRING, -1);
		$this->pay_mode->Sortable = TRUE; // Allow sort
		$this->fields['pay_mode'] = &$this->pay_mode;
		$this->pay_mode->DateFilter = "";
		$this->pay_mode->SqlSelect = "";
		$this->pay_mode->SqlOrderBy = "";

		// banktrxid
		$this->banktrxid = new crField('date_vise_payment', 'date vise payment', 'x_banktrxid', 'banktrxid', '`banktrxid`', 200, EWR_DATATYPE_STRING, -1);
		$this->banktrxid->Sortable = TRUE; // Allow sort
		$this->fields['banktrxid'] = &$this->banktrxid;
		$this->banktrxid->DateFilter = "";
		$this->banktrxid->SqlSelect = "";
		$this->banktrxid->SqlOrderBy = "";

		// pay_amount
		$this->pay_amount = new crField('date_vise_payment', 'date vise payment', 'x_pay_amount', 'pay_amount', '`pay_amount`', 20, EWR_DATATYPE_NUMBER, -1);
		$this->pay_amount->Sortable = TRUE; // Allow sort
		$this->pay_amount->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_amount'] = &$this->pay_amount;
		$this->pay_amount->DateFilter = "";
		$this->pay_amount->SqlSelect = "";
		$this->pay_amount->SqlOrderBy = "";

		// pay_date
		$this->pay_date = new crField('date_vise_payment', 'date vise payment', 'x_pay_date', 'pay_date', '`pay_date`', 135, EWR_DATATYPE_DATE, 0);
		$this->pay_date->Sortable = TRUE; // Allow sort
		$this->pay_date->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['pay_date'] = &$this->pay_date;
		$this->pay_date->DateFilter = "";
		$this->pay_date->SqlSelect = "SELECT DISTINCT `pay_date`, `pay_date` AS `DispFld` FROM " . $this->getSqlFrom();
		$this->pay_date->SqlOrderBy = "`pay_date`";
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`date vise payment`";
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
