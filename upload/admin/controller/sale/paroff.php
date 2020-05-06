<?php
class ControllerSaleParoff extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('sale/paroff');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/paroff');

		$this->getList();
	}

	public function add() {
		$this->load->language('sale/paroff');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/paroff');



		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			
			$this->model_sale_paroff->addReturn($this->request->post);


			$this->session->data['success'] = $this->language->get('text_success');


			$url = '';

			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_return_status_id'])) {
				$url .= '&filter_return_status_id=' . urlencode(html_entity_decode($this->request->get['filter_return_status_id'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
			}
            
            if (isset($this->request->get['filter_age'])) {
				$url .= '&filter_age=' . urlencode(html_entity_decode($this->request->get['filter_age'], ENT_QUOTES, 'UTF-8'));
			}
			
            if (isset($this->request->get['filter_comment'])) {
				$url .= '&filter_comment=' . urlencode(html_entity_decode($this->request->get['filter_comment'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_company'])) {
				$url .= '&filter_company=' . urlencode(html_entity_decode($this->request->get['filter_company'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_form'])) {
				$url .= '&filter_form=' . urlencode(html_entity_decode($this->request->get['filter_form'], ENT_QUOTES, 'UTF-8'));
			}


			if (isset($this->request->get['id'])) {
				$url .= '&id=' . urlencode(html_entity_decode($this->request->get['id'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['return_id'])) {
				$url .= '&return_id=' . urlencode(html_entity_decode($this->request->get['return_id'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_document'])) {
				$url .= '&filter_document=' . urlencode(html_entity_decode($this->request->get['filter_document'], ENT_QUOTES, 'UTF-8'));
			}
			

			if (isset($this->request->get['return_status_id'])) {
				$url .= '&return_status_id=' . urlencode(html_entity_decode($this->request->get['return_status_id'], ENT_QUOTES, 'UTF-8'));
			}
			

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['id'])) {
				$url .= '&id=' . $this->request->get['id'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('sale/paroff');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/paroff');


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_paroff->editReturn($this->request->get['id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';


		
			

			if (isset($this->request->get['filter_return_status_id'])) {
				$url .= '&filter_return_status_id=' . urlencode(html_entity_decode($this->request->get['filter_return_status_id'], ENT_QUOTES, 'UTF-8'));
			}
			if (isset($this->request->get['filter_return_id'])) {
				$url .= '&filter_return_id=' . urlencode(html_entity_decode($this->request->get['filter_id'], ENT_QUOTES, 'UTF-8'));
			}
            
            
			
       

			$this->response->redirect($this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('sale/paroff');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/paroff');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id) {
				$this->model_sale_paroff->deleteReturn($id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_id'])) {
				$url .= '&filter_id=' . $this->request->get['filter_id'];
			}

			if (isset($this->request->get['filter_order_id'])) {
				$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
			}

			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_company'])) {
				$url .= '&filter_company=' . urlencode(html_entity_decode($this->request->get['filter_company'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_form'])) {
				$url .= '&filter_form=' . urlencode(html_entity_decode($this->request->get['filter_form'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_return_status_id'])) {
				$url .= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['filter_id'])) {
			$filter_id = $this->request->get['filter_id'];
		} else {
			$filter_id = null;
		}

		if (isset($this->request->get['filter_order_id'])) {
			$filter_order_id = $this->request->get['filter_order_id'];
		} else {
			$filter_order_id = null;
		}

		if (isset($this->request->get['filter_customer'])) {
			$filter_customer = $this->request->get['filter_customer'];
		} else {
			$filter_customer = null;
		}

		if (isset($this->request->get['filter_company'])) {
			$filter_company = $this->request->get['filter_company'];
		} else {
			$filter_company = null;
		}

		if (isset($this->request->get['filter_form'])) {
			$filter_form = $this->request->get['filter_form'];
		} else {
			$filter_form = null;
		}

		if (isset($this->request->get['filter_return_status_id'])) {
			$filter_return_status_id = $this->request->get['filter_return_status_id'];
		} else {
			$filter_return_status_id = null;
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$filter_date_modified = $this->request->get['filter_date_modified'];
		} else {
			$filter_date_modified = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_id'])) {
			$url .= '&filter_id=' . $this->request->get['filter_id'];
		}

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_company'])) {
			$url .= '&filter_company=' . urlencode(html_entity_decode($this->request->get['filter_company'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_form'])) {
			$url .= '&filter_form=' . urlencode(html_entity_decode($this->request->get['filter_form'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_return_status_id'])) {
			$url .= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('sale/paroff/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('sale/paroff/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['returns'] = array();

		$filter_data = array(
			'filter_id'        => $filter_id,
			'filter_order_id'         => $filter_order_id,
			'filter_customer'         => $filter_customer,
			'filter_company'          => $filter_company,
			'filter_form'             => $filter_form,

 
			'filter_return_status_id' => $filter_return_status_id,
			'filter_date_added'       => $filter_date_added,
			'filter_date_modified'    => $filter_date_modified,
			'sort'                    => $sort,
			'order'                   => $order,
			'start'                   => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                   => $this->config->get('config_limit_admin')
		);

		$return_total = $this->model_sale_paroff->getTotalReturns($filter_data);

		$results = $this->model_sale_paroff->getReturns($filter_data);

		foreach ($results as $result) {
			$data['returns'][] = array(
				'customer'      => $result['customer'],
				'id'      => $result['id'],
				'return_id'      => $result['id'],
 				'email'       => $result['email'],
				'age'       => $result['age'],
				'form'       => $result['form'],
				'status'        => $result['status'],
				'comment'       => $result['comment'],
				'company'       => $result['company'],
				'document'       => $result['document'],
				'edit'          => $this->url->link('sale/paroff/edit', 'token=' . $this->session->data['token'] . '&return_id=' . $result['id'] . $url, true)
			
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_id'] = $this->language->get('column_id');
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_customer'] = $this->language->get('column_customer');
		$data['column_product'] = $this->language->get('column_product');
		$data['column_product'] = $this->language->get('column_product');
		$data['column_email'] = $this->language->get('column_email');

		$data['column_comment'] = $this->language->get('column_comment');
		$data['column_age'] = $this->language->get('column_age');
		$data['column_company'] = $this->language->get('column_company'); 
		$data['column_document'] = $this->language->get('column_document');
		
		$data['column_model'] = $this->language->get('column_model');
		$data['column_form'] = $this->language->get('column_form');

		$data['column_status'] = $this->language->get('column_status');

		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_date_modified'] = $this->language->get('column_date_modified');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_id'] = $this->language->get('entry_id');
		$data['entry_order_id'] = $this->language->get('entry_order_id');
		$data['entry_status'] = $this->language->get('entry_status');
        $data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_form'] = $this->language->get('entry_form');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_status'] = $this->language->get('entry_status');




		$data['entry_date_added'] = $this->language->get('entry_date_added');
		$data['entry_date_modified'] = $this->language->get('entry_date_modified');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['token'] = $this->session->data['token'];

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_id'])) {
			$url .= '&filter_id=' . $this->request->get['filter_id'];
		}

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_company'])) {
			$url .= '&filter_company=' . urlencode(html_entity_decode($this->request->get['filter_company'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_form'])) {
			$url .= '&filter_form=' . urlencode(html_entity_decode($this->request->get['filter_form'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_return_status_id'])) {
			$url .= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_customer'] = $this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, true);
		$data['sort_email'] = $this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . '&sort=email' . $url, true);
		$data['sort_status'] = $this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . '&sort=status' . $url, true);
		$data['sort_age'] = $this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . '&sort=age' . $url, true);
		$data['sort_comment'] = $this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . '&sort=comment' . $url, true);
		$data['sort_company'] = $this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . '&sort=company' . $url, true);
		$data['sort_form'] = $this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . '&sort=form' . $url, true);

		$url = '';

		if (isset($this->request->get['filter_id'])) {
			$url .= '&filter_id=' . $this->request->get['filter_id'];
		}

		if (isset($this->request->get['filter_company'])) {
			$url .= '&filter_company=' . $this->request->get['filter_company'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_form'])) {
			$url .= '&filter_form=' . urlencode(html_entity_decode($this->request->get['filter_form'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_age'])) {
			$url .= '&filter_age=' . urlencode(html_entity_decode($this->request->get['filter_age'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_return_status_id'])) {
			$url .= '&filter_return_status_id=' . $this->request->get['filter_return_status_id'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $return_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($return_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($return_total - $this->config->get('config_limit_admin'))) ? $return_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $return_total, ceil($return_total / $this->config->get('config_limit_admin')));

		$data['filter_id'] = $filter_id;
		$data['filter_order_id'] = $filter_order_id;
		$data['filter_customer'] = $filter_customer;
		$data['filter_form'] = $filter_form;
		$data['filter_company'] = $filter_company;

		$data['filter_return_status_id'] = $filter_return_status_id;
		$data['filter_date_added'] = $filter_date_added;
		$data['filter_date_modified'] = $filter_date_modified;

		$this->load->model('localisation/return_status');

		$data['return_statuses'] = $this->model_localisation_return_status->getReturnStatuses();

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/paroff_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_opened'] = $this->language->get('text_opened');
		$data['text_unopened'] = $this->language->get('text_unopened');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_history'] = $this->language->get('text_history');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_comment'] = $this->language->get('entry_comment');
		$data['entry_age'] = $this->language->get('entry_age');
		$data['entry_document'] = $this->language->get('entry_document');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_form'] = $this->language->get('entry_form');

		$data['entry_status'] = $this->language->get('entry_status');

		$data['help_product'] = $this->language->get('help_product');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_history_add'] = $this->language->get('button_history_add');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_history'] = $this->language->get('tab_history');

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['id'])) {
			$data['id'] = $this->request->get['id'];
		} else {
			$data['id'] = 0;
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['order_id'])) {
			$data['error_order_id'] = $this->error['order_id'];
		} else {
			$data['error_order_id'] = '';
		}

		if (isset($this->error['firstname'])) {
			$data['error_firstname'] = $this->error['firstname'];
		} else {
			$data['error_firstname'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['error_lastname'] = $this->error['lastname'];
		} else {
			$data['error_lastname'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

        if (isset($this->error['status'])) {
			$data['error_email'] = $this->error['status'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['age'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['company'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['comment'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['document'])) {
			$data['error_email'] = $this->error['document'];
		} else {
			$data['error_email'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_id'])) {
			$url .= '&filter_id=' . $this->request->get['filter_id'];
		}

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_company'])) {
			$url .= '&filter_company=' . urlencode(html_entity_decode($this->request->get['filter_company'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_form'])) {
			$url .= '&filter_form=' . urlencode(html_entity_decode($this->request->get['filter_form'], ENT_QUOTES, 'UTF-8'));
		}


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['id'])) {
			$data['action'] = $this->url->link('sale/paroff/add', 'token=' . $this->session->data['token'] . '&return_id=' . $this->request->get['return_id'] . $url, true);
		} else {
			$data['action'] = $this->url->link('sale/paroff/edit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('sale/paroff', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$return_info = $this->model_sale_paroff->getReturn($this->request->get['id']);
		}
		

		

		if (isset($this->request->post['customer'])) {
			$data['customer'] = $this->request->post['customer'];
		} elseif (!empty($return_info)) {
			$data['customer'] = $return_info['customer'];
		} else {
			$data['customer'] = '';
		}

		

		if (isset($this->request->post['firstname'])) {
			$data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($return_info)) {
			$data['firstname'] = $return_info['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} elseif (!empty($return_info)) {
			$data['lastname'] = $return_info['lastname'];
		} else {
			$data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($return_info)) {
			$data['email'] = $return_info['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($return_info)) {
			$data['status'] = $return_info['status'];
		} else {
			$data['status'] = '';
		}

		if (isset($this->request->post['age'])) {
			$data['age'] = $this->request->post['age'];
		} elseif (!empty($return_info)) {
			$data['age'] = $return_info['age'];
		} else {
			$data['age'] = '';
		}


		if (isset($this->request->post['comment'])) {
			$data['comment'] = $this->request->post['comment'];
		} elseif (!empty($return_info)) {
			$data['comment'] = $return_info['comment'];
		} else {
			$data['comment'] = '';
		}

		if (isset($this->request->post['comment'])) {
			$data['comment'] = $this->request->post['comment'];
		} elseif (!empty($return_info)) {
			$data['comment'] = $return_info['comment'];
		} else {
			$data['comment'] = '';
		}


		if (isset($this->request->post['company'])) {
			$data['company'] = $this->request->post['company'];
		} elseif (!empty($return_info)) {
			$data['company'] = $return_info['company'];
		} else {
			$data['company'] = '';
		}


	


		$this->load->model('localisation/return_reason');

		$data['return_reasons'] = $this->model_localisation_return_reason->getReturnReasons();

		if (isset($this->request->post['return_action_id'])) {
			$data['return_action_id'] = $this->request->post['return_action_id'];
		} elseif (!empty($return_info)) {
			$data['return_action_id'] = $return_info['return_action_id'];
		} else {
			$data['return_action_id'] = '';
		}

		$this->load->model('localisation/return_action');

		$data['return_actions'] = $this->model_localisation_return_action->getReturnActions();

		if (isset($this->request->post['comment'])) {
			$data['comment'] = $this->request->post['comment'];
		} elseif (!empty($return_info)) {
			$data['comment'] = $return_info['comment'];
		} else {
			$data['comment'] = '';
		}

		if (isset($this->request->post['return_status_id'])) {
			$data['return_status_id'] = $this->request->post['return_status_id'];
		} elseif (!empty($return_info)) {
			$data['return_status_id'] = $return_info['return_status_id'];
		} else {
			$data['return_status_id'] = '';
		}

		$this->load->model('localisation/return_status');

		$data['return_statuses'] = $this->model_localisation_return_status->getReturnStatuses();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/paroff_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'sale/paroff')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (empty($this->request->post['order_id'])) {
			$this->error['order_id'] = $this->language->get('error_order_id');
		}

		


		

		



		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'sale/paroff')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function history() {
		$this->load->language('sale/paroff');

		$data['error'] = '';
		$data['success'] = '';

		$this->load->model('sale/paroff');

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if (!$this->user->hasPermission('modify', 'sale/paroff')) {
				$data['error'] = $this->language->get('error_permission');
			}

			if (!$data['error']) {
				$this->model_sale_return->addReturnHistory($this->request->get['id'], $this->request->post);

				$data['success'] = $this->language->get('text_success');
			}
		}

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_notify'] = $this->language->get('column_notify');
		$data['column_comment'] = $this->language->get('column_comment');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['histories'] = array();

		$results = $this->model_sale_paroff->getReturnHistories($this->request->get['id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$data['histories'][] = array(
				'notify'     => $result['notify'] ? $this->language->get('text_yes') : $this->language->get('text_no'),
				'status'     => $result['status'],
				'comment'    => nl2br($result['comment']),
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$history_total = $this->model_sale_paroff->getTotalReturnHistories($this->request->get['id']);

		$pagination = new Pagination();
		$pagination->total = $history_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('sale/paroff/history', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

		$this->response->setOutput($this->load->view('sale/return_history', $data));
	}
}