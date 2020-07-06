import os
import zipfile
import rarfile
import errno

# Current directory
dir_path = os.getcwd()

def zip(archive,root):
    zip_ref = zipfile.ZipFile(archive, 'r')

    zip_con = [zip_ref.namelist()]
    for f in zip_con[0]:
        if f.endswith('/'):
            try:
                #Extracts all and breaks the loop
                zip_ref.extractall(root)
                break
            except(OSError, IOError) as err:
                if err.errno != errno.EEXIST:
                    raise
        elif not f.endswith('/') and not os.path.isdir(new_folder):
            try:
                #Creates a new directory to place the extracted files
                os.makedirs(new_folder)
                zip_ref.extractall(new_folder)
            except OSError as exc:
                if exc.errno == errno.EEXIST and os.path.isdir(new_folder):
                    pass

def rar(archive, root):
    rar_ref = rarfile.RarFile(archive, 'r')

    rar_ref.extractall(root)

# root provides all path information, files returns actual file name + extension
for root, dirs, files in os.walk(dir_path):
    for name in files:

        # Combines the file name into the path information for a full file location
        path = root + '/' + name

        #Path to the archive
        archive = os.path.abspath(path)

        # OS path splits the name away from the file extension and path variable
        new_folder = os.path.splitext(archive)[0][0:]

        if name.endswith('.zip') or name.endswith('.cbz'):
            zip(archive, root)
            os.remove(archive)

        elif name.endswith('.cbr') or name.endswith('.rar'):
            rar(archive, root)
            os.remove(archive)
        
        else:
            print(name, " is not a folder")
