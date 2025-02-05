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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="<?= base_url() ?> assets/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?> assets/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?> assets/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?> assets/AdminLTE-3.2.0/dist/js/demo.js"></script>
</body>

</html>