<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificacoes extends CI_Controller {
	
	public function index()
	{
/*
		// busca transacoes por intervalo de data
		
		$url = "https://ws.pagseguro.uol.com.br/v2/transactions?initialDate=2016-03-01T00:00&finalDate=2016-03-22T23:59&page=1&maxPageResults=100&email=engel.laureen@gmail.com&token=3A641C47DFF542E6A26974069E5DF5E6";

		$ch = curl_init("$url");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch);
		curl_close($ch);
		
		$xml = simplexml_load_string($data);
		
		echo "<pre>";
		print_r($xml);
		echo "</pre>";
*/
	
	}
	
	public function ReceberDados ()
	{
		$this->load->model('Notificacoes_model', 'model');
		
		//$a = "1";
		
		$code 	= $_POST['notificationCode'];
		//$code	= "BF6992-FA80F280F2FF-5444332F9449-6E2941";
		
		if($code)
		{
			
			
			# begin - check the notification code and get the transaction code #
			
			$notificationCode 	= $code;
			$email_ac			= "engel.laureen@gmail.com";
			$token_ac			= "3A641C47DFF542E6A26974069E5DF5E6";
			
			$urlNot = "https://ws.pagseguro.uol.com.br/v3/transactions/notifications/$notificationCode?email=$email_ac&token=$token_ac";
			
			$chNot = curl_init("$urlNot");
			curl_setopt($chNot, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($chNot, CURLOPT_HEADER, 0);
			$dataNot = curl_exec($chNot);
			curl_close($chNot);
			
			$xmlNot = simplexml_load_string($dataNot);
			
			$transactionCode =  $xmlNot->code;
			
			# end - check the notification code and get the transaction code #
			
			$url2 = "https://ws.pagseguro.uol.com.br/v2/transactions/$transactionCode?email=$email_ac&token=$token_ac";
		
			$ch = curl_init("$url2");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$data = curl_exec($ch);
			curl_close($ch);
			
			$xml = simplexml_load_string($data);
			
			
			$paymentMethod 	= $xml->paymentMethod;
			$sender 		= $xml->sender;
			$senderPhone	= $sender->phone;
			
			$reference = explode("-", $xml->reference);
			
			if(@$reference[0] == 'pedido')
			{
				//echo 'entrou'.$reference[1];
				
				//exit;
				// venda de produto
				$data2 = array (
					'data_alteracao'		=> date("Y-m-d H:i:s"),
					'date'					=> (string)$xml->date,
					'code'					=> (string)$xml->code,
					'reference'				=> (string)$xml->reference,
					'type'					=> (string)$xml->type,
					'status'				=> (string)$xml->status,
					'lastEventDate'			=> (string)$xml->lastEventDate,
					'paymentMethod_type'	=> (string)$paymentMethod->type,
					'paymentMethod_code'	=> (string)$paymentMethod->code,
					'grossAmount'			=> (string)$xml->grossAmount,
					'discountAmount'		=> (string)$xml->discountAmount,
					'feeAmount'				=> (string)$xml->feeAmount,
					'netAmount'				=> (string)$xml->netAmount,
					'escrowEndDate'			=> (string)$xml->escrowEndDate,
					'installmentCount'		=> (string)$xml->installmentCount,
					'itemCount'				=> (string)$xml->itemCount,
					'sender_name'			=> (string)$sender->name,
					'sender_email'			=> (string)$sender->email,
					'sender_phone'			=> (string)$senderPhone->areaCode." ".$senderPhone->number
						
				);
				
				$this->model->updatePedido((string)$reference[1], $data2);
				
				$status = (string)$xml->status;
				
				if($status == 3) // status 3 é pagamento recebido, só entra aqui nesse caso
				{
					$pedido_a = $this->model->getPedido((string)$reference[1]);
					
					foreach ($xml->items as $item):
						foreach ($item as $estoque):
						
							//echo $estoque->id;
						
							if($pedido_a->estoque_atualizado == 'N')
							{
								$id_estoque = explode("-", $estoque->id);
								
								$realEstoque = $this->model->getEstoque((string)$id_estoque[1]);
								$quantidade = (string)$estoque->quantity;
								
								$novoEstoque = $realEstoque->estoque-$quantidade;
								$this->model->updateEstoque($realEstoque->id_produto_estoque, $novoEstoque);
								$this->model->updateEstoqueAtualizado($pedido_a->id_pedido);
								
								// somente aqui atualiza o estoque, de acordo com esse pedido, depois atualiza o estoque para atualiza
								// assim esse pedido nao atualiza mais estoque pra nao seguir diminuindo depois de pago :)
							}
						endforeach;
					endforeach;
				}
			}
			else
			{
				$data2 = array (
					'data_alteracao'		=> date("Y-m-d H:i:s"),
					'date'					=> (string)$xml->date,
					'code'					=> (string)$xml->code,
					'reference'				=> (string)$xml->reference,
					'type'					=> (string)$xml->type,
					'status'				=> (string)$xml->status,
					'lastEventDate'			=> (string)$xml->lastEventDate,
					'paymentMethod_type'	=> (string)$paymentMethod->type,
					'paymentMethod_code'	=> (string)$paymentMethod->code,
					'grossAmount'			=> (string)$xml->grossAmount,
					'discountAmount'		=> (string)$xml->discountAmount,
					'feeAmount'				=> (string)$xml->feeAmount,
					'netAmount'				=> (string)$xml->netAmount,
					'escrowEndDate'			=> (string)$xml->escrowEndDate,
					'installmentCount'		=> (string)$xml->installmentCount,
					'itemCount'				=> (string)$xml->itemCount,
					'sender_name'			=> (string)$sender->name,
					'sender_email'			=> (string)$sender->email,
					'sender_phone'			=> (string)$senderPhone->areaCode." ".$senderPhone->number
						
				);
				
				$this->model->updateApadrinhamento((string)$xml->reference, $data2);
				
				$status = (string)$xml->status;
				
				if($status == 3) // status 3 é pagamento recebido, só entra aqui nesse caso
				{
					$idApadrinhamento = (string)$xml->reference;
					 
					$apadrinhamento = $this->model->getApadrinhamento($idApadrinhamento);
					$padrinho		= $this->model->getPadrinho($apadrinhamento->id_padrinho);
					
					$this->model->updatePadrinho($padrinho->id_padrinho, $apadrinhamento->id_animal, $apadrinhamento->id_apadrinhamento_tipo);
				}
			}
		}
		else
		{
			echo "Errou";
		}
	}
	
	public function buscaTransacao($code = "")
	{

		$this->load->model('Notificacoes_model', 'model');
				
		$url2 = "https://ws.pagseguro.uol.com.br/v2/transactions/92DFA493-4A44-41AA-9C81-AA2718A80C20?email=engel.laureen@gmail.com&token=3A641C47DFF542E6A26974069E5DF5E6";
		
		$ch = curl_init("$url2");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch);
		curl_close($ch);
		
		$xml = simplexml_load_string($data);
		
		
		$paymentMethod 	= $xml->paymentMethod;
		$sender 		= $xml->sender;
		$senderPhone	= $sender->phone;
		
		$reference = explode("-", $xml->reference);
		
		if(@$reference[0] == 'pedido')
		{
			echo 'entrou'.$reference[1];
			
			//exit;
			// venda de produto
			$data2 = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'date'					=> (string)$xml->date,
				'code'					=> (string)$xml->code,
				'reference'				=> (string)$xml->reference,
				'type'					=> (string)$xml->type,
				'status'				=> (string)$xml->status,
				'lastEventDate'			=> (string)$xml->lastEventDate,
				'paymentMethod_type'	=> (string)$paymentMethod->type,
				'paymentMethod_code'	=> (string)$paymentMethod->code,
				'grossAmount'			=> (string)$xml->grossAmount,
				'discountAmount'		=> (string)$xml->discountAmount,
				'feeAmount'				=> (string)$xml->feeAmount,
				'netAmount'				=> (string)$xml->netAmount,
				'escrowEndDate'			=> (string)$xml->escrowEndDate,
				'installmentCount'		=> (string)$xml->installmentCount,
				'itemCount'				=> (string)$xml->itemCount,
				'sender_name'			=> (string)$sender->name,
				'sender_email'			=> (string)$sender->email,
				'sender_phone'			=> (string)$senderPhone->areaCode." ".$senderPhone->number
					
			);
			
			$this->model->updatePedido((string)$reference[1], $data2);
			
		}
		else
		{
			$data2 = array (
				'data_alteracao'		=> date("Y-m-d H:i:s"),
				'date'					=> (string)$xml->date,
				'code'					=> (string)$xml->code,
				'reference'				=> (string)$xml->reference,
				'type'					=> (string)$xml->type,
				'status'				=> (string)$xml->status,
				'lastEventDate'			=> (string)$xml->lastEventDate,
				'paymentMethod_type'	=> (string)$paymentMethod->type,
				'paymentMethod_code'	=> (string)$paymentMethod->code,
				'grossAmount'			=> (string)$xml->grossAmount,
				'discountAmount'		=> (string)$xml->discountAmount,
				'feeAmount'				=> (string)$xml->feeAmount,
				'netAmount'				=> (string)$xml->netAmount,
				'escrowEndDate'			=> (string)$xml->escrowEndDate,
				'installmentCount'		=> (string)$xml->installmentCount,
				'itemCount'				=> (string)$xml->itemCount,
				'sender_name'			=> (string)$sender->name,
				'sender_email'			=> (string)$sender->email,
				'sender_phone'			=> (string)$senderPhone->areaCode." ".$senderPhone->number
					
			);
			
			$this->model->updateApadrinhamento((string)$xml->reference, $data2);
		}

	}
}