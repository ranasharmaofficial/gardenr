<!DOCTYPE html>
<html>
   <head>
      <title>Invoice - V2F BAAZAR</title>
      <style>
         body{
         font-family: 'Segoe UI', sans-serif;
         background:#f2f2f2;
         }
         .invoice{
         width:900px;
         margin:auto;
         background:white;
         padding:30px;
         box-shadow:0 0 10px rgba(0,0,0,0.1);
         }
         /* HEADER */
         .header{
         display:flex;
         justify-content:space-between;
         align-items:center;
         border-bottom:3px solid #2d89ef;
         padding-bottom:15px;
         }
         .brand{
         font-size:32px;
         font-weight:bold;
         color:#2d89ef;
         }
         .address{
         font-size:14px;
         color:#555;
         }
         /* BILL INFO */
         .bill-info{
         margin-top:20px;
         display:flex;
         justify-content:space-between;
         }
         .bill-info div{
         font-size:14px;
         line-height:24px;
         }
         /* TABLE */
         table{
         width:100%;
         border-collapse:collapse;
         margin-top:25px;
         }
         table thead{
         background:#2d89ef;
         color:white;
         }
         table th{
         padding:12px;
         font-size:14px;
         }
         table td{
         padding:12px;
         border-bottom:1px solid #ddd;
         text-align:center;
         }
         table tbody tr:hover{
         background:#f9f9f9;
         }
         /* TOTAL BOX */
         .total-box{
         width:300px;
         margin-top:20px;
         float:right;
         }
         .total-box table td{
         text-align:right;
         }
         .grand{
         background:#2d89ef;
         color:white;
         font-weight:bold;
         font-size:18px;
         }
         /* FOOTER */
         .footer{
         clear:both;
         margin-top:80px;
         display:flex;
         justify-content:space-between;
         }
         .sign{
         text-align:right;
         }
         /* PRINT */
         .print-btn{
         text-align:center;
         margin-top:30px;
         }
         button{
         padding:10px 25px;
         border:none;
         background:#2d89ef;
         color:white;
         font-size:14px;
         cursor:pointer;
         }
         @media print{
         body{
         background:white;
         }
         .print-btn{
         display:none;
         }
         .invoice{
         box-shadow:none;
         }
         }
      </style>
   </head>
   <body>
      <div class="invoice">
         <!-- HEADER -->
         <div class="header">
            <div>
               <div class="brand">V2F BAAZAR</div>
               <div class="address">
                  Kaptanpara Khuskibagh, Purnia<br>
                  Mobile : +91 9471052961
               </div>
            </div>
            <div style="text-align:right;">
               <h2>INVOICE</h2>
            </div>
         </div>
         <!-- BILL DETAILS -->
         <div class="bill-info">
            <div>
               <strong>Bill No :</strong> {{ $sale->id }} <br>
               <strong>Date :</strong> {{ date('d-m-Y', strtotime($sale->created_at)) }}
            </div>
            <div>
               <strong>Customer :</strong> {{ $sale->vm_name ?? '-' }} <br>
               <strong>Mobile :</strong> {{ $sale->vm_mobile ?? '-' }}<br>
               <strong>Address :</strong> {{ $sale->vm_address ?? '-' }}
            </div>
         </div>
         <!-- PRODUCT TABLE -->
         <table>
            <thead>
               <tr>
                  <th>#</th>
                  <th style="text-align:left">Product</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Total</th>
               </tr>
            </thead>
            <tbody>
               @php $grandTotal = 0; @endphp
               @foreach($saleItems as $key => $item)
				@php
				   $total = $item->quantity * $item->price;
				   $grandTotal += $total;
				@endphp
               <tr>
                  <td>{{ $key+1 }}</td>
                  <td style="text-align:left">{{ $item->product_name }}</td>
                  <td>{{ $item->quantity }}</td>
                  <td>₹ {{ number_format($item->price,2) }}</td>
                  <td>₹ {{ number_format($total,2) }}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <!-- TOTAL -->
         <div class="total-box">
            <table width="100%">
               <tr>
                  <td><strong>Grand Total :</strong></td>
                  <td><strong>₹ {{ number_format($grandTotal,2) }}</strong></td>
               </tr>
            </table>
         </div>
         <!-- FOOTER -->
         <div class="footer">
            <div>
               <strong>Terms & Conditions</strong><br>
               Goods once sold will not be returned.
            </div>
            <div class="sign">
               <br><br>
               ____________________<br>
               Authorized Signature
            </div>
         </div>
         <div class="print-btn">
            <button onclick="window.print()">Print Invoice</button>
         </div>
      </div>
   </body>
</html>