
            <div class="card">
                <div class="card-header" align="right">
                  <div class="row">
                    <div class="col" align="left">
                      <p><h6>Daftar Jumlah Mahasiswa Berdasarkan Jalur Masuk dan UKT</h6></p>
                    </div>
                    <div class="col" align="right">
                      <a  href="{{route ('jaluruktfti.excel')}}" class="btn btn-success">Export to Excel</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['url' => 'jaluruktfti','class' => 'ajax']) !!}
                    <div class="row">
                      <div class="col form-group">
                          {!! Form::select('jlrmsk',$jalur,null,['class' => 'form-control','placeholder'=>'Pilih Jalur Masuk ...'])!!}
                      </div>
                      <div class="col form-group">
                        {!! Form::submit('Click Me!',array('class' => 'btn btn-primary'))!!}
                      </div>
                    </div>
                    {!! Form::close() !!}

                    <?php
                      if(isset($_POST['jlrmsk'])){
                    ?>

                    <table class="table">
                      <tr>
                          <th>NIM</th>
                          <th>Nama</th>
                          <th>Jurusan</th>
                          <th>Jalur Masuk</th>
                          <th>Jumlah Tarif</th>
                      </tr>
                      @foreach($query1 as $query)
                      <tr>
                          <td>{{$query ->mhsNiu}}</td>
                          <td>{{$query ->mhsNama}}</td>
                          <td>{{$query ->prodi}}</td>
                          <td>{{$query ->jalur}}</td>
                          <td>{{$query ->jumlah}}</td>
                      </tr>
                      @endforeach
                    </table>
                    <?php  }?>

                </div>
            </div>
