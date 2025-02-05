<div class="container mt-5">
    <h1 class="mb-4">FASTA Analysis Tool</h1>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Fixed Header Table</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>RNA Function Analysis</th>
                            <th>Sequence ID</th>
                            <th>Sequence Length</th>
                            <th>Sequence</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_rna as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->description_fasta ?></td>
                                <td><?= $value->function_fasta ?></td>
                                <td><?= $value->sequenceid_fasta ?></td>
                                <td><?= $value->sequencelength_fasta ?></td>
                                <td><?= $value->sequence_fasta ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>