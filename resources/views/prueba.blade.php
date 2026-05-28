@extends('layouts.prueba')
@section('prueba')
  <div class="container">
    <header>
      <div class="logo">Hospital inventory</div>
      <nav>
        <a href="#">Dashboard</a>
        <a href="#">Inventario</a>
        <a href="#" class="active">Otros</a>
      </nav>
      <button class="btn">menu</button>
      <button class="btn">Usuario</button>
    </header>
    
    <div class="row p-3">
        <div class="col">
            <h1>Administrar Items</h1>
            <p class="subtitle">Revisar y realizar un seguimiento de los suministros recientes.</p>
        </div>
    
        <div class="search-box col">
          <input type="text" placeholder="Buscar...">
        </div>
    </div>

    <section class="orders-section">
      <h2>Recientes</h2>
      <table>
        <thead>
          <tr>
            
            <th>Item</th>
            <th>Cantidad</th>
            <th>Estado</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <tr> 
            <td>Item 1</td>
            <td>50</td>
            <td><span class="status in-stock">Estado 1</span></td>
            <td>2025-06-10</td>
          </tr>
          <tr>
            <td>Item 2</td>
            <td>30</td>
            <td><span class="status low-stock">Estado 2</span></td>
            <td>2025-06-12</td>
          </tr>
          <tr>
            <td>Item 3</td>
            <td>15</td>
            <td><span class="status out-stock">Estado 3</span></td>
            <td>2025-06-13</td>
          </tr>
        </tbody>
      </table>
    </section>
  </div>
@endsection