<script setup lang="ts">
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog';
import Button from '@/components/ui/button/Button.vue';
import { Card, CardContent } from '@/components/ui/card';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { Check, SquarePen, Trash2 } from 'lucide-vue-next';
import { reactive, watch } from 'vue';

const th = reactive([
    {
        THead: 'No',
    },
    {
        THead: 'Name Category',
    },
    {
        THead: 'Action',
    },
]);

// getall data from inertia
interface Category {
    id: number;
    name_category: string;
}

interface Props {
    category: Category[];
}

const categories = defineProps<Props>();

// title
const title = 'Category';

// broadcump
const breadcump: BreadcrumbItem[] = [
    {
        title: title,
        href: '/category',
    },
];

const page = usePage();

const form = useForm({
    name_category: '',
});

// for create
const CreateSubmit = () => {
    form.post(route('category.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset('name_category'),
    });
};

const DeleteSubmit = () => {
    form.delete(route('category.delete'));
};
// hide alert after 3s
watch(
    () => page.props.flash?.message,
    (value) => {
        if (value) {
            setTimeout(() => {
                page.props.flash.message = null;
            }, 3000);
        }
    },
);
</script>

<template>
    <Head :title="title" />
    <AppLayout :breadcrumbs="breadcump">
        <div class="p-5">
            <div class="flex justify-between p-4">
                <h1 class="text-3xl font-bold">Category</h1>

                <!-- take a message from session for notification -->
                <div v-if="page.props.flash?.message" class="fixed top-10 right-3 mb-4" id="alert">
                    <Alert class="bg-green-400">
                        <Check />
                        <AlertTitle> Success! </AlertTitle>
                        <AlertDescription>
                            {{ page.props.flash.message }}
                        </AlertDescription>
                    </Alert>
                </div>

                <!-- create -->
                <Dialog>
                    <DialogTrigger class="mt-6">
                        <Button class="bg-green-500 hover:bg-green-600"> New Category </Button>
                    </DialogTrigger>

                    <DialogContent>
                        <DialogHeader>
                            <DialogTitle> Create New Category </DialogTitle>
                            <DialogDescription> Add your product category here. Click create when finished. </DialogDescription>
                        </DialogHeader>
                        <form @submit.prevent="CreateSubmit">
                            <fieldset>
                                <!-- name category -->
                                <div class="mb-5 space-y-3">
                                    <Label for="name_category"> Name Category </Label>
                                    <Input
                                        id="name_category"
                                        required
                                        placeholder="Enter the name category products...."
                                        v-model="form.name_category"
                                    />
                                    <div v-if="form.errors.name_category" class="text-sm text-red-500">{{ form.errors.name_category }}</div>
                                </div>
                            </fieldset>
                            <DialogFooter class="mt-4">
                                <DialogClose as-child>
                                    <Button class="bg-gray-400 p-3 hover:bg-gray-500"> Close </Button>
                                </DialogClose>
                                <!-- <DialogClose> -->
                                <Button type="submit" class="bg-green-600 p-3 hover:bg-green-700" :disabled="form.processing"> Create </Button>
                                <!-- </DialogClose> -->
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>
            </div>

            <div class="p-4">
                <Card>
                    <CardContent>
                        <!-- table -->
                        <Table>
                            <TableHeader>
                                <TableHead v-for="h in th" :key="h.THead" class="text-center">{{ h.THead }}</TableHead>
                            </TableHeader>

                            <TableBody>
                                <TableRow v-for="(c, index) in categories.category" :key="index" class="text-center">
                                    <TableCell>{{ index + 1 }}</TableCell>
                                    <TableCell>{{ c.name_category }}</TableCell>
                                    <TableCell class="space-x-2">
                                        <!-- view -->

                                        <!-- update -->
                                        <Dialog>
                                            <DialogTrigger>
                                                <Button class="bg-yellow-500 hover:bg-yellow-600"> <SquarePen /> </Button>
                                            </DialogTrigger>

                                            <DialogContent>
                                                <DialogHeader>
                                                    <DialogTitle> Update Category </DialogTitle>
                                                    <DialogDescription>
                                                        Update your product category here. Click Save when finished.
                                                    </DialogDescription>
                                                </DialogHeader>
                                            </DialogContent>
                                        </Dialog>

                                        <!-- delete -->
                                        <AlertDialog>
                                            <AlertDialogTrigger>
                                                <Button class="bg-red-500 hover:bg-red-600"> <Trash2 /> </Button>
                                            </AlertDialogTrigger>

                                            <AlertDialogContent>
                                                <AlertDialogHeader>
                                                    <AlertDialogTitle>Delete Category</AlertDialogTitle>
                                                    <AlertDialogDescription> Apakah Anda Yakin Menghapus Data Ini? </AlertDialogDescription>
                                                </AlertDialogHeader>
                                                <AlertDialogFooter>
                                                    <AlertDialogCancel>Cancel</AlertDialogCancel>
                                                    <form @submit.prevent="DeleteSubmit">

                                                        <AlertDialogAction type="submit" class="bg-red-500 hover:bg-red-600"> Delete </AlertDialogAction>
                                                    </form>
                                                </AlertDialogFooter>
                                            </AlertDialogContent>
                                        </AlertDialog>
                                    </TableCell>
                                </TableRow>
                            </TableBody>

                            <TableCaption> A list of your recend category </TableCaption>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
