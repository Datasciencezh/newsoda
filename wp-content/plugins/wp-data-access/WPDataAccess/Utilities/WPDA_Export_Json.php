<?php

/**
 * Suppress "error - 0 - No summary was found for this file" on phpdoc generation
 *
 * @package WPDataAccess\Utilities
 */

namespace WPDataAccess\Utilities {

	use WPDataAccess\WPDA;

	/**
	 * Class WPDA_Export_Json
	 *
	 * @author  Peter Schulz
	 * @since   2.0.13
	 */
	class WPDA_Export_Json extends WPDA_Export_Formatted {

		/**
		 * Variable used for loop processing
		 *
		 * @var bool
		 */
		protected $first_row = true;

		/**
		 * File header for JSON export
		 *
		 * @since   2.0.13
		 */
		protected function header() {
			WPDA::sent_header( 'application/json', null, "{$this->table_names}.json" );

			echo '{ "table": "' . esc_attr( $this->table_names ) . '"';
			echo ', "info": "Generated by WP Data Access"';
			echo ', "time": "' . esc_attr( gmdate( 'Y-m-d\TH:i:s\Z' ) ) . '"';
			if ( is_array( $this->rows ) && count( $this->rows ) > 0 ) {//phpcs:ignore - 8.1 proof
				echo ', "columns": [';
				$first_col = true;
				foreach ( $this->rows[0] as $column_name => $column_value ) {
					if ( $first_col ) {
						$first_col = false;
					} else {
						echo ', ';
					}
					echo '"' . esc_attr( $column_name) . '"';
				}
				echo ']';
			}
			echo ', "row_count": ' . esc_attr( $this->row_count );
			echo ', "rows": [';
		}

		/**
		 * Process one row to be export in JSON format
		 *
		 * @param array $row
		 *
		 * @since   2.0.13
		 */
		protected function row( $row ) {
			if ( $this->first_row ) {
				$this->first_row = false;
			} else {
				echo ', ';
			}
			echo '[';
			$first_col = true;
			foreach ( $row as $column_name => $column_value ) {
				if ( $first_col ) {
					$first_col = false;
				} else {
					echo ', ';
				}

				if ( null === $column_value ) {
					echo 'null';
				} else {
					$is_string = 'number' === WPDA::get_type( $this->data_types[ $column_name ] ) ? '' : '"';
					echo $is_string . $column_value . $is_string; // phpcs:ignore WordPress.Security.EscapeOutput
				}
			}
			echo ']';
		}

		/**
		 * File footer for JSON export
		 *
		 * @since   2.0.13
		 */
		protected function footer() {
			echo ']}';
		}

	}

}
