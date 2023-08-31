# no shebang due to the context of the call
# Check if both arguments are provided
if [ $# -ne 2 ]; then
    echo "Usage: $0 <id> <data>"
    exit 1
fi

# Extract arguments
name="$1"
data="$2"

# Defining path
tmp_path="/mnt/rd/"
data_path="$tmp_path/$name.acf"
echo "$data_path"

# owner
owner="acst"
name="$1"

# writting to ram disk
echo "$data" | tee "$data_path"

# calling the recs program

doas encore write "$data_path" "$owner" "$name"

# Verbose stuff for debugging
echo "$data"

