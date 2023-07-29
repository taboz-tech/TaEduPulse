# public function lilt()
# {
#     $this->genlib->ajaxOnly();

#     $this->load->helper('text');

#     // set the sort order
#     $orderBy = $this->input->get('orderBy', TRUE) ? $this->input->get('orderBy', TRUE) : "name";
#     $orderFormat = $this->input->get('orderFormat', TRUE) ? $this->input->get('orderFormat', TRUE) : "ASC";

#     // Log sort order values
#     log_message('debug', 'Order By: ' . $orderBy);
#     log_message('debug', 'Order Format: ' . $orderFormat);

#     // count the total number of items in db
#     $totalItems = $this->db->count_all('items');

#     $this->load->library('pagination');

#     $pageNumber = $this->uri->segment(3, 0); // set page number to zero if the page number is not set in the third segment of URI

#     $limit = $this->input->get('limit', TRUE) ? $this->input->get('limit', TRUE) : 10; // show $limit per page
#     $start = $pageNumber == 0 ? 0 : ($pageNumber - 1) * $limit; // start from 0 if pageNumber is 0, else start from the next iteration

#     // Log pagination values
#     log_message('debug', 'Page Number: ' . $pageNumber);
#     log_message('debug', 'Limit: ' . $limit);
#     log_message('debug', 'Start: ' . $start);

#     // call setPaginationConfig($totalRows, $urlToCall, $limit, $attributes) in genlib to configure pagination
#     $config = $this->genlib->setPaginationConfig($totalItems, "items/lilt", $limit, ['onclick' => 'return lilt(this.href);']);

#     $this->pagination->initialize($config); // initialize the library class

#     // get all items from db
#     $data['allItems'] = $this->item->getAll($orderBy, $orderFormat, $start, $limit);
#     $data['range'] = $totalItems > 0 ? "Showing " . ($start + 1) . "-" . ($start + count($data['allItems'])) . " of " . $totalItems : "";
#     $data['links'] = $this->pagination->create_links(); // page links
#     $data['sn'] = $start + 1;
#     $data['cum_total'] = $this->item->getItemsCumTotal();
#     $categories = $this->category->getCat();
#     $data['categories'] = array_column($categories, 'name', 'id');

#     // Log $data array
#     log_message('debug', 'Data array: ' . json_encode($data));

#     $json['itemsListTable'] = $this->load->view('items/itemslisttable', $data, TRUE); // get view with populated items table

#     // Log the JSON response
#     log_message('debug', 'JSON Response: ' . json_encode($json));

#     $this->output->set_content_type('application/json')->set_output(json_encode($json));
# }
