<div class="container mt-5">
    <h1 class="mb-4">FASTA Analysis Tool</h1>

    <form id="fastaForm" class="mb-4">
        <div class="mb-3">
            <label for="fasta_data" class="form-label">Enter FASTA Sequence:</label>
            <textarea class="form-control" id="fasta_data" name="fasta_data" rows="10" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Analyze</button>
        <a href="<?= base_url() ?>rna/index" class="btn btn-primary">back</a>
    </form>

    <div id="error" class="alert alert-danger" role="alert" style="display: none;"></div>

    <div id="results" class="results mt-4" style="display: none;">
        <form method="post" action="<?= base_url() ?>rna/create_rna" class="mb-4">
            <h2>Analysis Results</h2>

            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Description</h5>
                    <input type="text" name="description_fasta" id="description" class="form-control" readonly>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">RNA Function Analysis</h5>
                    <input type="text" name="function_fasta" id="rna_function" class="form-control" readonly>
                </div>
            </div>


            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Sequence Information</h5>
                    <label><strong>Sequence ID:</strong></label>
                    <input type="text" name="sequenceid_fasta" id="sequence_id" class="form-control" readonly>
                    <label><strong>Sequence Length:</strong></label>
                    <input type="text" name="sequencelength_fasta" id="sequence_length" class="form-control" readonly>
                    <label><strong>Sequence:</strong></label>
                    <textarea style="resize: none;" name="sequence_fasta" id="sequence" class="form-control sequence-box" rows="11" readonly></textarea>
                    <button type="submit" class="btn btn-primary">Analyze</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function parseFasta(fastaData) {
        const lines = fastaData.trim().split('\n');
        if (lines.length < 2) {
            throw new Error("Invalid FASTA format: Must contain header and sequence");
        }

        const header = lines[0];
        if (!header.startsWith('>')) {
            throw new Error("Invalid FASTA format: Header must start with '>'");
        }

        const sequence = lines.slice(1).join('').replace(/\s/g, '');
        return {
            header: header,
            sequence: sequence
        };
    }

    function extractDescription(header) {
        const match = header.match(/^>(.*)/);
        return match ? match[1] : "No description found.";
    }

    function analyzeRNAFunction(description) {
        description = description.toLowerCase();
        if (description.includes("messenger rna") || description.includes("mrna")) {
            return "Messenger RNA (mRNA): membawa informasi genetik dari DNA ke ribosom untuk sintesis protein.";
        } else if (description.includes("micro rna") || description.includes("mirna")) {
            return "MicroRNA (miRNA): mengatur ekspresi gen melalui penghambatan translasi atau degradasi mRNA target.";
        } else if (description.includes("ribosomal rna") || description.includes("rrna")) {
            return "Ribosomal RNA (rRNA): bagian struktural dan fungsional ribosom, penting untuk sintesis protein.";
        } else if (description.includes("transfer rna") || description.includes("trna")) {
            return "Transfer RNA (tRNA): membawa asam amino ke ribosom selama translasi.";
        } else {
            return "RNA dengan fungsi yang belum jelas atau tidak ditemukan dalam database lokal.";
        }
    }

    document.getElementById('fastaForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const fastaData = document.getElementById('fasta_data').value;

        try {
            const parsed = parseFasta(fastaData);
            const description = extractDescription(parsed.header);
            const rnaFunction = analyzeRNAFunction(description);

            // Display results
            document.getElementById('error').style.display = 'none';
            document.getElementById('results').style.display = 'block';
            document.getElementById('description').value = description;
            document.getElementById('rna_function').value = rnaFunction;
            document.getElementById('sequence_id').value = description.split(' ')[0];
            document.getElementById('sequence_length').value = parsed.sequence.length;
            document.getElementById('sequence').value = parsed.sequence;
        } catch (error) {
            document.getElementById('results').style.display = 'none';
            document.getElementById('error').style.display = 'block';
            document.getElementById('error').textContent = error.message;
        }
    });
</script>